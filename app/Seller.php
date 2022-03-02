<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use SoftDeletes;

    protected $table = 'sellers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'proposal_id', 'user_id', 'detail'
    ];

    public function proposal()
    {
    	return $this->belongsTo(Proposal::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
