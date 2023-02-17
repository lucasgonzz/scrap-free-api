<?php

namespace Database\Seeders;

use App\Models\Resolution;
use Illuminate\Database\Seeder;

class ResolutionSeeder extends Seeder
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
                'name' => 'Aprovado',
            ],
            [
                'name' => 'Rechazado',
            ],
            [
                'name' => 'Desistio',
            ],
            [
                'name' => 'Otros',
            ],
        ];
        foreach ($models as $model) {
            Resolution::create([
                'name' => $model['name'],
            ]);
        }
    }
}
