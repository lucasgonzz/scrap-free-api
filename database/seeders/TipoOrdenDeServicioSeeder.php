<?php

namespace Database\Seeders;

use App\Models\TipoOrdenDeServicio;
use Illuminate\Database\Seeder;

class TipoOrdenDeServicioSeeder extends Seeder
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
                'num'    => 1,
                'nombre' => 'Auditoria',
                'user_id'   => 1,
            ],
            [
                'num'    => 2,
                'nombre' => 'Reparacion',
                'user_id'   => 1,
            ],
        ];
        foreach ($models as $model) {
            TipoOrdenDeServicio::create($model);
        }
    }
}
