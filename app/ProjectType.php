<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectType extends Model
{
    use SoftDeletes;

    protected $table = 'project_types';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code'
    ];

    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];
    
    public function visits()
    {
    	return $this->hasMany(Visit::class);
    }
        
    public function proposals()
    {
    	return $this->hasMany(Proposal::class);
    }

    public function projects()
    {
    	return $this->hasMany(Project::class);
    }
}
