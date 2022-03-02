<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presentacion extends Model
{
    use SoftDeletes;

    protected $table = 'presentaciones';
    
    protected $fillable = [
        'nombre', 'presentacion_id'
    ];

    public function presentation()
    {
    	return $this->belongsTo(Presentacion::class);
    }
    
    public function consolidados()
    {
    	return $this->hasMany(Consolidado::class);
    }
}
