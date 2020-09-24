<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('fecha_recepcion');
            $table->string('persona_documento');
            $table->string('persona_telefono');
            $table->string('persona_edad');
            $table->string('persona_sexo');
            $table->string('persona_nombre');
            $table->string('persona_eess');
            $table->string('persona_direccion');
            $table->string('persona_distrito');
            $table->string('persona_provincia');
            $table->string('persona_localidad');
            $table->string('persona_personal_salud')->nullable();
            $table->string('persona_fecha_sintomas');
            $table->string('prueba_fecha_ejecucion');
            $table->string('prueba_fecha_resultado');
            $table->string('prueba_tipo');
            $table->string('prueba_resultado');
            $table->string('prueba_tamizaje');
            $table->string('prueba_insumos');
            $table->text('observacion');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichas');
    }
}
