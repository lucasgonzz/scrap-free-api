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
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AseguradoraSeeder::class);
        $this->call(AseguradoSeeder::class);
        $this->call(RamoSeeder::class);
        $this->call(CoberturaSeeder::class);
        $this->call(TipoProductoDeSeguroSeeder::class);
        $this->call(TecnicoSeeder::class);
        $this->call(CausaSiniestroSeeder::class);
        $this->call(TipoOrdenDeServicioSeeder::class);
        $this->call(EstadoBienSeeder::class);
        $this->call(CausaBienSeeder::class);
        // $this->call(DeprecationSeeder::class);
        // $this->call(ResolutionSeeder::class);
        $this->call(EstadoGeneralSiniestroSeeder::class);
        $this->call(EstadoSiniestroSeeder::class);
        $this->call(UnidadNegocioSeeder::class);
        $this->call(LineaSeeder::class);
        $this->call(SubLineaSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(LocalidadSeeder::class);
        $this->call(GestorScrapFreeSeeder::class);
        $this->call(GestorAseguradoraSeeder::class);
        $this->call(TransportistaSeeder::class);
        $this->call(SiniestroSeeder::class);
    }
}
