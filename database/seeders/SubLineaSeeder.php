<?php

namespace Database\Seeders;

use App\Models\Linea;
use App\Models\SubLinea;
use Illuminate\Database\Seeder;

class SubLineaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lineas = Linea::all();
        $num = 1;
        foreach ($lineas as $linea) {
            for ($index =1; $index  < 5; $index ++) { 
                SubLinea::create([
                    'num'       => $num,
                    'nombre'    => 'Sub linea '.$linea->nombre.' '.$index,
                    'linea_id'  => $linea->id,
                    'user_id'   => 1,
                ]);
                $num++;
            }
        }
    }
}
