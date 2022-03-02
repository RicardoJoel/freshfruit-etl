<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_type_id', 'customer_id', 'user_id', 'proposal_id', 
        'code', 'name', 'happen_at', 'changed_at', 'status'
    ];
    
    /**
     * Default values for attributes
     * @var array an array with attribute as key and default as value
     */
    protected $attributes = [
        'status' => 'O'
    ];

    public function getNameCodeAttribute() {
        return $this->name.' ('.$this->code.')';
    }

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
    
    public function proposal()
    {
    	return $this->belongsTo(Proposal::class);
    }

    public function activities()
    {
    	return $this->hasMany(Activity::class);
    }

    public function tasks()
    {
    	return $this->hasMany(Task::class)->orderBy('row');
    }

    public function resources()
    {
    	return $this->belongsToMany(User::class)
                    ->wherePivotNull('deleted_at')
                    ->withTimestamps();
    }
}
