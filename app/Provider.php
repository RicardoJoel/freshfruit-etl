<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;

    protected $table = 'providers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'proposal_id', 'profile_id', 'currency_id', 'exchange_rate_id', 'detail', 'price'
    ];

    public function getSubtotalAttribute() {
        return ($this->exchangeRate->value ?? 1) * $this->price;
    }

    public function proposal()
    {
    	return $this->belongsTo(Proposal::class);
    }

    public function profile()
    {
    	return $this->belongsTo(Profile::class);
    }

    public function currency()
    {
    	return $this->belongsTo(Currency::class);
    }

    public function exchangeRate()
    {
    	return $this->belongsTo(ExchangeRate::class);
    }
}
