<?php

namespace Database\Seeders;

use App\Models\Transportista;
use Illuminate\Database\Seeder;

class TransportistaSeeder extends Seeder
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
                'nombre'                    => 'Bogdan',
                'user_id'                   => 1,
            ],
            [
                'num'                       => 2,
                'nombre'                    => 'Mosto',
                'user_id'                   => 1,
            ],
        ];
        foreach ($models as $model) {
            Transportista::create($model);
        }
    }
}
