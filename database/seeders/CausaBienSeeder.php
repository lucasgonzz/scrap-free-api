<?php

namespace Database\Seeders;

use App\Models\CausaBien;
use Illuminate\Database\Seeder;

class CausaBienSeeder extends Seeder
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
                'nombre'                    => 'Se rompio',
                'descripcion'               => 'Cuando se rompe por culpa del asegurado',
                'user_id'                   => 1,
            ],
            [
                'num'                       => 2,
                'nombre'                    => 'Se quemo',
                'descripcion'               => 'Cuando se quema por muhco uso por parte del asegurado',
                'user_id'                   => 1,
            ],
        ];
        foreach ($models as $model) {
            CausaBien::create($model);
        }
    }
}
