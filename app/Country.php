<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $table = 'countries';
    
    protected $fillable = [
        'name', 'code', 'mob_pattern'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }
    
    public function contacts()
    {
    	return $this->hasMany(Contact::class);
    }

    public function freelancers()
    {
    	return $this->hasMany(Freelancer::class);
    }

    public function suppliers()
    {
    	return $this->hasMany(Supplier::class);
    }
}
