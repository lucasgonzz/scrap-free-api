<?php

namespace Database\Seeders;

use App\Models\Tecnico;
use Illuminate\Database\Seeder;

class TecnicoSeeder extends Seeder
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
                'num'       => 1,
                'nombre'    => 'Bulo',
                'user_id'   => 1,
            ],
        ];
        foreach ($models as $model) {
            Tecnico::create($model);
        }
    }
}
