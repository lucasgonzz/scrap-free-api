<?php

namespace Database\Seeders;

use App\Models\AssetStatus;
use Illuminate\Database\Seeder;

class AssetStatusSeeder extends Seeder
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
            AssetStatus::create([
                'nombre' => $model['nombre'],
            ]);
        }
    }
}
