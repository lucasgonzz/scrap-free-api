<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(InsurerSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CauseSeeder::class);
        $this->call(ServiceOrderTypeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(DeprecationSeeder::class);
        $this->call(BusinessUnitSeeder::class);
        $this->call(ResolutionSeeder::class);
    }
}
