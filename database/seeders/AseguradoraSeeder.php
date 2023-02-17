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
                'num'    => 1,
                'nombre' => 'Sancor',
            ],
            [
                'num'    => 2,
                'nombre' => 'MetLife',
            ],
        ];
        foreach ($models as $model) {
            Aseguradora::create([
                'num'    => $model['num'],
                'nombre' => $model['nombre'],
                'user_id'   => 1,
            ]);
        }
    }
}
