<?php

namespace Database\Seeders;

use App\Models\SinisterStatus;
use Illuminate\Database\Seeder;

class SinisterStatusSeeder extends Seeder
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
                'name' => 'Aprobado',
            ],
            [
                'name' => 'Rechazo',
            ],
            [
                'name' => 'Carta documento',
            ],
        ];
        foreach ($models as $model) {
            SinisterStatus::create([
                'name' => $model['name'],
            ]);
        }
    }
}
