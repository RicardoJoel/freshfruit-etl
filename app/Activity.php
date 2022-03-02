<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $table = 'activities';
    
    protected $fillable = [
        'project_id', 'task_id', 'user_id', 'start_at', 'end_at', 'description', 'comment', 'color'
    ];

    public function project()
    {
    	return $this->belongsTo(Project::class);
    }

    public function task()
    {
    	return $this->belongsTo(Task::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
