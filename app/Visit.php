<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Visit extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visits';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_type_id', 'customer_id', 'user_id', 'happen_at', 'is_done', 'by_reference', 'prop_code', 'observation'
    ];

    /**
     * Default values for attributes
     * @var array an array with attribute as key and default as value
     */
    protected $attributes = [
        'is_done' => false, 'by_reference' => false
    ];
        
    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'code'
    ];

    public function projectType()
    {
    	return $this->belongsTo(ProjectType::class);
    }

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
    
    public function accountable()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function proposals()
    {
    	return $this->hasMany(Proposal::class);
    }
    
    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Visit $visit) {
            $maxCod = Visit::where('code','like','V'.date('Y').'%')->max(\DB::raw('substr(code,6,3)'));
            $visit->code = 'V'.date('Y').str_pad(++$maxCod,3,'0',STR_PAD_LEFT);
            return true;
        });
    }
}
