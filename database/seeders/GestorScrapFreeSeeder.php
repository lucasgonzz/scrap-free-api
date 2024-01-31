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
                'nombre'                => 'Fran',
                'svg'                   => 'http://scrap-free.local:8000/storage/hammer.svg',
                'nombre_formal'         => 'Francisco',
                'unidad_negocio_id'     => 1, 
                'user_id'               => 1,
            ],
            [
                'num'                   => 2,
                'nombre'                => 'Reca',
                'nombre_formal'         => 'Ramiro',
                'svg'                   => 'http://scrap-free.local:8000/storage/glass.svg',
                'unidad_negocio_id'     => 1, 
                'user_id'               => 1,
            ],
            [
                'num'                   => 3,
                'nombre'                => 'Clari',
                'nombre_formal'         => 'Clarisa',
                'svg'                   => 'http://scrap-free.local:8000/storage/queen.svg',
                'unidad_negocio_id'     => 1, 
                'user_id'               => 1,
            ],
        ];
        foreach ($models as $model) {
            GestorScrapFree::create($model);
        }
    }
}
