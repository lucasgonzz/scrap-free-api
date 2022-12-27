<?php

namespace Database\Seeders;

use App\Models\Aseguradora;
use Illuminate\Database\Seeder;

class AseguradoraSeeder extends Seeder
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
                'nombre' => 'Sancor',
            ],
            [
                'nombre' => 'MetLife',
            ],
        ];
        foreach ($models as $model) {
            Aseguradora::create([
                'nombre' => $model['nombre'],
            ]);
        }
    }
}
