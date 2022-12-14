<?php

namespace Database\Seeders;

use App\Models\Insurer;
use Illuminate\Database\Seeder;

class InsurerSeeder extends Seeder
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
            Insurer::create([
                'nombre' => $model['nombre'],
            ]);
        }
    }
}
