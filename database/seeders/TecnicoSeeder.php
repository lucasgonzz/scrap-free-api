<?php

namespace Database\Seeders;

use App\Models\Tecnico;
use App\Models\TecnicoAsegurado;
use App\Models\TecnicoScrapFree;
use Illuminate\Database\Seeder;

class TecnicoSeeder extends Seeder
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
                'num'       => 1,
                'nombre'    => 'Tecnico para elegir',
                'user_id'   => 1,
            ],
        ];
        foreach ($models as $model) {
            TecnicoAsegurado::create($model);
            TecnicoScrapFree::create($model);
        }
    }
}
