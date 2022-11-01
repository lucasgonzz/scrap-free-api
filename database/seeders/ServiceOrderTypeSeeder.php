<?php

namespace Database\Seeders;

use App\Models\ServiceOrderType;
use Illuminate\Database\Seeder;

class ServiceOrderTypeSeeder extends Seeder
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
                'name' => 'Auditoria',
            ],
            [
                'name' => 'Reparacion',
            ],
        ];
        foreach ($models as $model) {
            ServiceOrderType::create([
                'name' => $model['name'],
            ]);
        }
    }
}
