<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employees';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'proposal_id', 'profile_id', 'detail', 'hourly_rate', 'num_hours'
    ];

    public function getSubtotalAttribute() {
        return $this->hourly_rate * $this->num_hours;
    }

    public function proposal()
    {
    	return $this->belongsTo(Proposal::class);
    }

    public function profile()
    {
    	return $this->belongsTo(Profile::class);
    }
}
