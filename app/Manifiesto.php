<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manifiesto extends Model
{
    //use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manifiesto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'nro_bultos', 'fec_zarpe', 'peso_bruto', 'aerolinea', 'nro_vuelo', 'fec_embarque', 
        'nave', 'nacionalidad', 'empresa', 'fec_aut_carga', 'fec_transmision', 'nro_detalles', 'tipo'
    ];

    public function conocimientos()
    {
    	return $this->hasMany(Conocimiento::class);
    }
}
