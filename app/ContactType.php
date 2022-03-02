<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactType extends Model
{
    use SoftDeletes;

    protected $table = 'contact_types';
    
    protected $fillable = [
        'name'
    ];

    public function contacts()
    {
    	return $this->hasMany(Contact::class);
    }
}
