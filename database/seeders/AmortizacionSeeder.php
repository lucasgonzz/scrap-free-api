<?php

namespace Database\Seeders;

use App\Models\Amortizacion;
use Illuminate\Database\Seeder;

class AmortizacionSeeder extends Seeder
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
                'anos'            => 0,
                'depreciacion'    => 0,
                'aseguradora_id'  => 1,
            ],
            [
                'anos'            => 1,
                'depreciacion'    => 0,
                'aseguradora_id'  => 1,
            ],
            [
                'anos'            => 2,
                'depreciacion'    => 0,
                'aseguradora_id'  => 1,
            ],
            [
                'anos'            => 3,
                'depreciacion'    => 15,
                'aseguradora_id'  => 1,
            ],
            [
                'anos'            => 4,
                'depreciacion'    => 25,
                'aseguradora_id'  => 1,
            ],
            [
                'anos'            => 5,
                'depreciacion'    => 30,
                'aseguradora_id'  => 1,
            ],
            [
                'anos'            => 6,
                'depreciacion'    => 40,
                'aseguradora_id'  => 1,
            ],
            [
                'anos'            => 7,
                'depreciacion'    => 50,
                'aseguradora_id'  => 1,
            ],
        ];

        foreach ($models as $model) {
            Amortizacion::create($model);
        }
    }
}
