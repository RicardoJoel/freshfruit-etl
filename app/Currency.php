<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;

    protected $table = 'currencies';
    
    protected $fillable = [
        'name', 'code'
    ];

    public function proposals()
    {
    	return $this->hasMany(Proposal::class);
    }

    public function independents()
    {
    	return $this->hasMany(Independent::class);
    }
}
