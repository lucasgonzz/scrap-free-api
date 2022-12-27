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
                'nombre' => 'Aprobado',
            ],
            [
                'nombre' => 'Rechazado',
            ],
            [
                'nombre' => 'Pendiente IT',
            ],
        ];
        foreach ($models as $model) {
            EstadoBien::create([
                'nombre' => $model['nombre'],
            ]);
        }
    }
}
