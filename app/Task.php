<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Task extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'row', 'code', 'name', 'start_at', 'end_at', 'start_ms', 'end_ms', 
        'status', 'progress', 'description', 'relevance', 'duration', 'depends', 'level'
    ];

    public function project()
    {
    	return $this->belongsTo(Project::class);
    }
    
    public function resources()
    {
    	return $this->belongsToMany(User::class)
                    ->wherePivotNull('deleted_at')
                    ->withTimestamps();
    }

    public function activities()
    {
    	return $this->hasMany(Activity::class);
    }
}
