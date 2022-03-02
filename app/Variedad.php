<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variedad extends Model
{
    use SoftDeletes;

    protected $table = 'variedades';
    
    protected $fillable = [
        'nombre', 'variedad_id', 'producto_id'
    ];
        
    public function variedad()
    {
    	return $this->belongsTo(Variedad::class);
    }
    
    public function producto()
    {
    	return $this->belongsTo(Producto::class);
    }
    
    public function consolidados()
    {
    	return $this->hasMany(Consolidado::class);
    }
}