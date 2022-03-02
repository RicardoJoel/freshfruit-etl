<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;

    protected $table = 'bussiness';
    
    protected $fillable = [
        'name'
    ];

    public function customers()
    {
    	return $this->hasMany(Customer::class);
    }
}
