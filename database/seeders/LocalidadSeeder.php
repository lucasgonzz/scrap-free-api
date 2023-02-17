<?php

namespace Database\Seeders;

use App\Http\Controllers\Controller;
use App\Models\Localidad;
use Illuminate\Database\Seeder;

class LocalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ct = new Controller();
        $models = [
            [
                'num'           => 1,
                'nombre'        => 'Gualeguay',
                'provincia_id'  => $ct->getModelBy('provincias', 'nombre', 'Entre Rios', false, 'id'),
                'user_id'       => 1,
            ],
            [
                'num'           => 2,
                'nombre'        => 'Victoria',
                'provincia_id'  => $ct->getModelBy('provincias', 'nombre', 'Entre Rios', false, 'id'),
                'user_id'       => 1,
            ],
            [
                'num'           => 3,
                'nombre'        => 'Lanus',
                'provincia_id'  => $ct->getModelBy('provincias', 'nombre', 'Buenos Aires', false, 'id'),
                'user_id'       => 1,
            ],
            [
                'num'           => 4,
                'nombre'        => 'Belgrano',
                'provincia_id'  => $ct->getModelBy('provincias', 'nombre', 'Buenos Aires', false, 'id'),
                'user_id'       => 1,
            ],
            [
                'num'           => 5,
                'nombre'        => 'Rosario',
                'provincia_id'  => $ct->getModelBy('provincias', 'nombre', 'Santa Fe', false, 'id'),
                'user_id'       => 1,
            ],
            [
                'num'           => 6,
                'nombre'        => 'Santa Fe',
                'provincia_id'  => $ct->getModelBy('provincias', 'nombre', 'Santa Fe', false, 'id'),
                'user_id'       => 1,
            ],
        ];
        foreach ($models as $model) {
            Localidad::create($model);
        }
    }
}
