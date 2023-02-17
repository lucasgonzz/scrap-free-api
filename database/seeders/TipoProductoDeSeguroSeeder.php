<?php

namespace Database\Seeders;

use App\Models\TipoProductoDeSeguro;
use Illuminate\Database\Seeder;

class TipoProductoDeSeguroSeeder extends Seeder
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
                'nombre'                    => 'De oficina',
                'user_id'                   => 1,
            ],
            [
                'num'                       => 2,
                'nombre'                    => 'Hogareño',
                'user_id'                   => 1,
            ],
        ];
        foreach ($models as $model) {
            TipoProductoDeSeguro::create($model);
        }
    }
}
