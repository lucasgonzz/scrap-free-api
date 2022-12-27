<?php

namespace Database\Seeders;

use App\Models\CausaSiniestro;
use Illuminate\Database\Seeder;

class CausaSiniestroSeeder extends Seeder
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
                'nombre' => 'Robo',
            ],
            [
                'nombre' => 'Rayo',
            ],
            [
                'nombre' => 'Accidente domestico',
            ],
            [
                'nombre' => 'Fluctuacion',
            ],
            [
                'nombre' => 'Otros',
            ],
        ];
        foreach ($models as $model) {
            CausaSiniestro::create([
                'nombre' => $model['nombre'],
            ]);
        }
    }
}
