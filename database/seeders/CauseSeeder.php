<?php

namespace Database\Seeders;

use App\Models\Cause;
use Illuminate\Database\Seeder;

class CauseSeeder extends Seeder
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
            Cause::create([
                'name' => $model['name'],
            ]);
        }
    }
}
