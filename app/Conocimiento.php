<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conocimiento extends Model
{
    //use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'conocimiento';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manifiesto_id', 'codigo', 'puerto', 'master', 'detalle', 'terminal', 'peso_org' ,'bulto_org',
        'peso_man', 'bulto_man', 'peso_rcb', 'bulto_rcb', 'consignatario', 'embarcador', 'fec_trans' 
    ];

    public function manifiesto()
    {
    	return $this->belongTo(Manifiesto::class);
    }

    public function detalles()
    {
    	return $this->hasMany(Detalle::class);
    }

    public function contenedores()
    {
    	return $this->hasMany(Contenedor::class);
    }
}
