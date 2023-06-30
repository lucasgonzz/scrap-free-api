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
                'num' => 1,
                'nombre' => 'Robo',
                'user_id'   => 1,
            ],
            [
                'num' => 2,
                'nombre' => 'Rayo',
                'user_id'   => 1,
            ],
            [
                'num' => 3,
                'nombre' => 'Accidente domestico',
                'user_id'   => 1,
            ],
            [
                'num' => 4,
                'nombre' => 'Fluctuacion',
                'user_id'   => 1,
            ],
            [
                'num' => 4,
                'nombre' => 'Evento no cubierto',
                'user_id'   => 1,
            ],
            [
                'num' => 4,
                'nombre' => 'Desgaste y/o vicios propios',
                'user_id'   => 1,
            ],
            [
                'num' => 5,
                'nombre' => 'Otros',
                'user_id'   => 1,
            ],
        ];
        foreach ($models as $model) {
            CausaSiniestro::create($model);
        }
    }
}
