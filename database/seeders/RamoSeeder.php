<?php

namespace Database\Seeders;

use App\Models\Ramo;
use Illuminate\Database\Seeder;

class RamoSeeder extends Seeder
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
                'num'                       => 1,
                'nombre'                    => 'Ramo importante',
                'user_id'                   => 1,
            ],
            [
                'num'                       => 2,
                'nombre'                    => 'Ramo no tan importante',
                'user_id'                   => 1,
            ],
        ];
        foreach ($models as $model) {
            Ramo::create($model);
        }
    }
}
