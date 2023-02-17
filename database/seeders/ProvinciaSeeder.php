<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
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
                'nombre'    => 'Entre Rios',
                'user_id'   => 1,
            ],
            [
                'num'       => 2,
                'nombre'    => 'Santa Fe',
                'user_id'   => 1,
            ],
            [
                'num'       => 3,
                'nombre'    => 'Buenos Aires',
                'user_id'   => 1,
            ],
        ];
        foreach ($models as $model) {
            Provincia::create($model);
        }
    }
}
