<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contenedor extends Model
{
    //use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contenedor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'conocimiento_id', 'numero', 'tamanio', 'condicion', 'tipo', 'operador', 'tara'
    ];

    public function conocimiento()
    {
    	return $this->belongTo(Conocimiento::class);
    }
}
