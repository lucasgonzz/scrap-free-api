<?php

namespace Database\Seeders;

use App\Models\GestorScrapFree;
use Illuminate\Database\Seeder;

class GestorScrapFreeSeeder extends Seeder
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
                'nombre'                => 'El mejor de scrap free',
                'nombre_formal'         => 'Francisco',
                'unidad_negocio_id'     => 1, 
                'user_id'               => 1,
            ],
            [
                'num'                   => 2,
                'nombre'                => 'El segundo mejor',
                'nombre_formal'         => 'Mauro Mambretti',
                'unidad_negocio_id'     => 1, 
                'user_id'               => 1,
            ],
        ];
        foreach ($models as $model) {
            GestorScrapFree::create($model);
        }
    }
}
