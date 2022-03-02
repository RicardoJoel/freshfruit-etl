<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;

    protected $table = 'types';
    
    protected $fillable = [
        'name', 'code'
    ];

    public function proposals()
    {
    	return $this->hasMany(Proposal::class);
    }
}
