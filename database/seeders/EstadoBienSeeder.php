<?php

namespace Database\Seeders;

use App\Models\EstadoBien;
use Illuminate\Database\Seeder;

class EstadoBienSeeder extends Seeder
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
                'nombre'    => 'Aprobado',
                'user_id'   => 1,
            ],
            [
                'num'       => 2,
                'nombre'    => 'Rechazado',
                'user_id'   => 1,
            ],
            [
                'num'       => 3,
                'nombre'    => 'Pendiente IT',
                'user_id'   => 1,
            ],
        ];
        foreach ($models as $model) {
            $estado = EstadoBien::create($model);
        }
    }
}
