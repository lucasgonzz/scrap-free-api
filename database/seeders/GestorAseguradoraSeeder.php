<?php

namespace Database\Seeders;

use App\Models\GestorAseguradora;
use Illuminate\Database\Seeder;

class GestorAseguradoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            [
                'num'                   => 1,
                'nombre'                => 'El mejor de las aseguradoras',
                'unidad_negocio_id'     => 1, 
                'user_id'               => 1,
            ],
            [
                'num'                   => 2,
                'nombre'                => 'El segundo mejor',
                'unidad_negocio_id'     => 1, 
                'user_id'               => 1,
            ],
        ];
        foreach ($models as $model) {
            GestorAseguradora::create($model);
        }
    }
}
