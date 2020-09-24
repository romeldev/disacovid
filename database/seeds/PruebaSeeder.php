<?php

use Illuminate\Database\Seeder;
use App\Prueba;

class PruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prueba::query()->delete();
        Prueba::insert($this->data());
    }

    public function data()
    {
        return [
            [ 'id' => 1, 'nombre' => 'PRUEBA RAPIDA' ],
            [ 'id' => 2, 'nombre' => 'PSR' ],
        ];
    }
}
