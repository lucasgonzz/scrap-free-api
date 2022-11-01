<?php

namespace Database\Seeders;

use App\Models\Deprecation;
use Illuminate\Database\Seeder;

class DeprecationSeeder extends Seeder
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
                'years'         => 1,
                'deprecation'   => 0,
            ],
            [
                'years'         => 2,
                'deprecation'   => 0,
            ],
            [
                'years'         => 3,
                'deprecation'   => 15,
            ],
            [
                'years'         => 4,
                'deprecation'   => 25,
            ],
            [
                'years'         => 5,
                'deprecation'   => 30,
            ],
            [
                'years'         => 6,
                'deprecation'   => 40,
            ],
            [
                'years'         => 7,
                'deprecation'   => 50,
            ],
        ];
        foreach ($models as $model) {
            Deprecation::create([
                'years'         => $model['years'],
                'deprecation'   => $model['deprecation'],
            ]);
        }
    }
}
