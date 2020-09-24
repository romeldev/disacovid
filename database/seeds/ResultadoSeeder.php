<?php

use Illuminate\Database\Seeder;
use App\Resultado;

class ResultadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resultado::query()->delete();
        Resultado::insert($this->data());
    }

    public function data()
    {
        return [
            [ 'prueba_id' => 1, 'nombre' => 'NO REACTIVO' ],
            [ 'prueba_id' => 1, 'nombre' => 'REACTIVO IgM' ],
            [ 'prueba_id' => 1, 'nombre' => 'REACTIVO IgG' ],
            [ 'prueba_id' => 1, 'nombre' => 'REACTIVO IgM/IgG' ],
            [ 'prueba_id' => 1, 'nombre' => 'INVALIDO' ],
            [ 'prueba_id' => 2, 'nombre' => 'POSITIVO' ],
            [ 'prueba_id' => 2, 'nombre' => 'NEGATIVO' ],
        ];
    }
}
