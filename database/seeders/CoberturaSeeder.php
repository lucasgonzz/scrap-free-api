<?php

namespace Database\Seeders;

use App\Models\Cobertura;
use Illuminate\Database\Seeder;

class CoberturaSeeder extends Seeder
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
                'num'                       => 1,
                'nombre'                    => 'Rayo',
                'user_id'                   => 1,
            ],
            [
                'num'                       => 2,
                'nombre'                    => 'Fluctuacion',
                'user_id'                   => 1,
            ],
            [
                'num'                       => 3,
                'nombre'                    => 'Tormentas',
                'user_id'                   => 1,
            ],
            [
                'num'                       => 4,
                'nombre'                    => 'Incendios',
                'user_id'                   => 1,
            ],
            [
                'num'                       => 5,
                'nombre'                    => 'Terremotos',
                'user_id'                   => 1,
            ],
        ];
        foreach ($models as $model) {
            $asegurado = Cobertura::create($model);
        }
    }
}
