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
        // $this->call(InsurerSeeder::class);
        $this->call(AseguradoraSeeder::class);
        // $this->call(SinisterCauseSeeder::class);
        $this->call(CausaSiniestroSeeder::class);
        // $this->call(ServiceOrderTypeSeeder::class);
        $this->call(TipoOrdenDeServicioSeeder::class);
        // $this->call(ClaimStatusSeeder::class);
        // $this->call(AssetStatusSeeder::class);
        $this->call(EstadoBienSeeder::class);
        // $this->call(DeprecationSeeder::class);
        // $this->call(ResolutionSeeder::class);
        // $this->call(SinisterStatusSeeder::class);
        $this->call(EstadoSiniestroSeeder::class);
        // $this->call(BusinessUnitSeeder::class);
        $this->call(UnidadNegocioSeeder::class);
        $this->call(LineaSeeder::class);
    }
}
