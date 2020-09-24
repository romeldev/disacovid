<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    public $table = 'pruebas';

    protected $fillable = [
        'codigo',
        'fecha_recepcion',

        'persona_documento',
        'persona_telefono',
        'persona_edad',
        'persona_sexo',
        'persona_nombre',
        'persona_eess',
        'persona_direccion',
        'persona_distrito',
        'persona_provincia',
        'persona_localidad',
        'persona_personal_salud',
        'persona_fecha_sintomas',

        'prueba_fecha_ejecucion',
        'prueba_fecha_resultado',
        'prueba_tipo',
        'prueba_resultado',
        'prueba_tamizaje',
        'prueba_insumos',
        'observacion',
    ];

    public function resultados()
    {
        return $this->hasMany( Resultado::class, 'prueba_id' );
    }

}
