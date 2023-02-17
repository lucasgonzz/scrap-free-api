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
                'num' => 1,
                'nombre' => 'Blanca',
                'user_id'   => 1,
            ],
            [
                'num' => 2,
                'nombre' => 'Marron',
                'user_id'   => 1,
            ],
            [
                'num' => 3,
                'nombre' => 'Gris',
                'user_id'   => 1,
            ],
            [
                'num' => 4,
                'nombre' => 'PAE',
                'user_id'   => 1,
            ],
        ];
        foreach ($models as $model) {
            Linea::create($model);
        }
    }
}
