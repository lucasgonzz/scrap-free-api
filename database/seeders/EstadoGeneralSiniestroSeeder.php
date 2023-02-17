<?php

namespace Database\Seeders;

use App\Models\EstadoGeneralSiniestro;
use Illuminate\Database\Seeder;

class EstadoGeneralSiniestroSeeder extends Seeder
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
                'num'   => 1,
                'nombre' => 'Aprobado',
                'user_id'   => 1,
            ],
            [
                'num'   => 2,
                'nombre' => 'Rechazo',
                'user_id'   => 1,
            ],
            [
                'num'   => 3,
                'nombre' => 'Carta documento',
                'user_id'   => 1,
            ],
        ];
        foreach ($models as $model) {
            EstadoGeneralSiniestro::create($model);
        }
    }
}
