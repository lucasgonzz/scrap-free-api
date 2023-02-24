<?php

namespace Database\Seeders;

use App\Models\CentroReparacion;
use Illuminate\Database\Seeder;

class CentroReparacionSeeder extends Seeder
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
                'num' => 1,
                'nombre' => 'Centro 1',
                'user_id'   => 1,
            ],
            [
                'num' => 2,
                'nombre' => 'Centro 2',
                'user_id'   => 1,
            ],
        ];
        foreach ($models as $model) {
            CentroReparacion::create($model);
        }
    }
}
