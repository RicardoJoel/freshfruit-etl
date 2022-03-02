<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeRate extends Model
{
    use SoftDeletes;

    protected $table = 'exchange_rates';
    
    protected $fillable = [
        'date', 'value'
    ];

    public function independents()
    {
    	return $this->hasMany(Independent::class);
    }

    public function providers()
    {
    	return $this->hasMany(Provider::class);
    }
}
