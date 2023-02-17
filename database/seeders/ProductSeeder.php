<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
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
                'name' => 'Hogar',
            ],
            [
                'name' => 'Basico',
            ],
        ];
        foreach ($models as $model) {
            Product::create([
                'name' => $model['name'],
            ]);
        }
    }
}
