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
                'nombre'                    => 'LCD Plasma',
                'user_id'                   => 1,
            ],
            [
                'num'                       => 2,
                'nombre'                    => 'Electrodomesticos',
                'user_id'                   => 1,
            ],
            [
                'num'                       => 3,
                'nombre'                    => 'Notebooks',
                'user_id'                   => 1,
            ],
        ];
        foreach ($models as $model) {
            $asegurado = Cobertura::create($model);
        }
    }
}
