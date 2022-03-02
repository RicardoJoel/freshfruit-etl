<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $table = 'productos';
    
    protected $fillable = [
        'nombre', 'producto_id'
    ];

    public function producto()
    {
    	return $this->belongsTo(Producto::class);
    }

    public function consolidados()
    {
    	return $this->hasMany(Consolidado::class);
    }
}
