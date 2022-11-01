<?php

namespace Database\Seeders;

use App\Models\Line;
use Illuminate\Database\Seeder;

class LineSeeder extends Seeder
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
                'name' => 'Blanca',
            ],
            [
                'name' => 'Marron',
            ],
            [
                'name' => 'Gris',
            ],
            [
                'name' => 'PAE',
            ],
        ];
        foreach ($models as $model) {
            Line::create([
                'name' => $model['name'],
            ]);
        }
    }
}
