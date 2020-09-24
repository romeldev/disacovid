<?php

use Illuminate\Database\Seeder;
use App\Distrito;

class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Distrito::query()->delete();
        Distrito::insert($this->data());
    }

    public function data()
    {
        return [
            [ 'id' => '1', 'nombre' => 'CUTERVO' , 'provincia_id' => '6' ],
            [ 'id' => '2', 'nombre' => 'CALLAYUC' , 'provincia_id' => '6' ],
            [ 'id' => '3', 'nombre' => 'CHOROS' , 'provincia_id' => '6' ],
            [ 'id' => '4', 'nombre' => 'CUJILLO' , 'provincia_id' => '6' ],
            [ 'id' => '5', 'nombre' => 'LA RAMADA' , 'provincia_id' => '6' ],
            [ 'id' => '6', 'nombre' => 'PINPINGOS' , 'provincia_id' => '6' ],
            [ 'id' => '7', 'nombre' => 'QUEROCOTILLO' , 'provincia_id' => '6' ],
            [ 'id' => '8', 'nombre' => 'SAN ANDRES DE CUTERVO' , 'provincia_id' => '6' ],
            [ 'id' => '9', 'nombre' => 'SAN JUAN DE CUTERVO' , 'provincia_id' => '6' ],
            [ 'id' => '10', 'nombre' => 'SAN LUIS DE LUCMA' , 'provincia_id' => '6' ],
            [ 'id' => '11', 'nombre' => 'SANTA CRUZ' , 'provincia_id' => '6' ],
            [ 'id' => '12', 'nombre' => 'SANTO DOMINGO DE LA CAPILLA' , 'provincia_id' => '6' ],
            [ 'id' => '13', 'nombre' => 'SANTO TOMAS' , 'provincia_id' => '6' ],
            [ 'id' => '14', 'nombre' => 'SOCOTA' , 'provincia_id' => '6' ],
            [ 'id' => '15', 'nombre' => 'TORIBIO CASANOVA' , 'provincia_id' => '6' ],
        ];
    }
}
