<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $table = 'empresas';
    
    protected $fillable = [
        'nombre', 'ruc', 'empresa_id'
    ];

    public function empresa()
    {
    	return $this->belongsTo(Empresa::class);
    }

    public function consolidados()
    {
    	return $this->hasMany(Consolidado::class);
    }
}
