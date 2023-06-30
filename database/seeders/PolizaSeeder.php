<?php

namespace Database\Seeders;

use App\Models\Poliza;
use Illuminate\Database\Seeder;

class PolizaSeeder extends Seeder
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
                'num'                           => 1,
                'asegurado_id'                  => 1,
                'numero_poliza'                 => '343622',
                'tipo_producto_de_seguro_id'    => 1,
                'ramo_id'                       => 1,
                'referencia'                    => '324543',
                'numero_asociado'               => '7657657657',
                'tipo_documento_id'             => 1,
                'numero_documento'              => '3454534534',
                'user_id'                       => 1,   
            ],
        ];
        foreach ($models as $model) {
            Poliza::create($model);
        }
    }
}
