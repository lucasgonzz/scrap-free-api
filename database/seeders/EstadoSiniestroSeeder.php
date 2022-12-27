<?php

namespace Database\Seeders;

use App\Models\EstadoSiniestro;
use Illuminate\Database\Seeder;

class EstadoSiniestroSeeder extends Seeder
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
                'nombre' => 'Aprobado',
            ],
            [
                'nombre' => 'Rechazo',
            ],
            [
                'nombre' => 'Carta documento',
            ],
        ];
        foreach ($models as $model) {
            EstadoSiniestro::create([
                'nombre' => $model['nombre'],
            ]);
        }
    }
}
