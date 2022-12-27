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
                'nombre' => 'Auditoria',
            ],
            [
                'nombre' => 'Reparacion',
            ],
        ];
        foreach ($models as $model) {
            TipoOrdenDeServicio::create([
                'nombre' => $model['nombre'],
            ]);
        }
    }
}
