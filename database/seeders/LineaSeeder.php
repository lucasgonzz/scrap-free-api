<?php

namespace Database\Seeders;

use App\Models\Linea;
use Illuminate\Database\Seeder;

class LineaSeeder extends Seeder
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
                'nombre' => 'Blanca',
            ],
            [
                'nombre' => 'Marron',
            ],
            [
                'nombre' => 'Gris',
            ],
            [
                'nombre' => 'PAE',
            ],
        ];
        foreach ($models as $model) {
            Linea::create([
                'nombre' => $model['nombre'],
            ]);
        }
    }
}
