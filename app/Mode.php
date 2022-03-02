<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mode extends Model
{
    use SoftDeletes;

    protected $table = 'modes';
    
    protected $fillable = [
        'name', 'code'
    ];

    public function proposals()
    {
    	return $this->hasMany(Proposal::class);
    }
}
