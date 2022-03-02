<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consolidado extends Model
{
    //use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'consolidado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [            
        'manifiesto_id', 'conocimiento_id', 'detalle_id', 'contenedor_id',
        'manifiesto', 'nave', 'empresa', 'num_detalles', 'fecha_salida', 
        'conocimiento', 'detalle_con', 'puerto', 'peso_man', 'bultos_man',
        'consignatario_con', 'embarcador_con', 'fecha_transm', 'num_bultos', 'peso_bruto', 
        'consignatario_det', 'embarcador_det', 'marcas_numeros', 'descripcion', 
        'numero', 'tamanio', 'condicion', 'tipo_cont', 'operador', 'tara', 'tipo_man',
        //Referencias a otras clases
        'producto_id', 'variedad_id', 'presentacion_id', 'organico'
    ];

    public function producto()
    {
    	return $this->belongsTo(Producto::class);
    }

    public function variedad()
    {
    	return $this->belongsTo(Variedad::class);
    }

    public function presentacion()
    {
    	return $this->belongsTo(Presentacion::class);
    }
}
