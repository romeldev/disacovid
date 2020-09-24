<?php

use Illuminate\Database\Seeder;
use App\Provincia;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::query()->delete();
        Provincia::insert($this->data());
    }

    public function data()
    {
        return [
            [ 'id' => '1', 'nombre' => 'Cajamarca' ],
            [ 'id' => '2', 'nombre' => 'Cajabamba' ],
            [ 'id' => '3', 'nombre' => 'Celendín' ],
            [ 'id' => '4', 'nombre' => 'Chota' ],
            [ 'id' => '5', 'nombre' => 'Contumazá' ],
            [ 'id' => '6', 'nombre' => 'Cutervo' ],
            [ 'id' => '7', 'nombre' => 'Hualgayoc' ],
            [ 'id' => '8', 'nombre' => 'Jaén' ],
            [ 'id' => '9', 'nombre' => 'San Ignacio' ],
            [ 'id' => '10', 'nombre' => 'San Marcos' ],
            [ 'id' => '11', 'nombre' => 'San Miguel' ],
            [ 'id' => '12', 'nombre' => 'San Pablo' ],
            [ 'id' => '13', 'nombre' => 'Santa Cruz' ],
        ];
    }
}
