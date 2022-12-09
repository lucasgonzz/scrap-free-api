<?php

namespace Database\Seeders;

use App\Models\SinisterCause;
use Illuminate\Database\Seeder;

class SinisterCauseSeeder extends Seeder
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
                'name' => 'Robo',
            ],
            [
                'name' => 'Rayo',
            ],
            [
                'name' => 'Accidente domestico',
            ],
            [
                'name' => 'Fluctuacion',
            ],
            [
                'name' => 'Otros',
            ],
        ];
        foreach ($models as $model) {
            SinisterCause::create([
                'name' => $model['name'],
            ]);
        }
    }
}
