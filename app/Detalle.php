<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalle extends Model
{
    //use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detalle';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'conocimiento_id', 'bultos', 'peso_bruto', 'empaques', 'embarcador', 'consignatario', 'marcas_numeros' ,'descripcion'
    ];

    public function conocimiento()
    {
    	return $this->belongTo(Conocimiento::class);
    }
}
