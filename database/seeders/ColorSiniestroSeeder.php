<?php

namespace Database\Seeders;

use App\Models\ColorSiniestro;
use App\Models\EstadoSiniestro;
use Illuminate\Database\Seeder;

class ColorSiniestroSeeder extends Seeder
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
                'name'                      => 'Verde',
                'dias_estado_siniestro_min' => null,
                'dias_estado_siniestro_max' => 3,
            ],
            [
                'name'                      => 'Amarillo',
                'dias_estado_siniestro_min' => 4,
                'dias_estado_siniestro_max' => 6,
            ],
            [
                'name'                      => 'Rojo',
                'dias_estado_siniestro_min' => 7,
                'dias_estado_siniestro_max' => null,
            ],
        ];
        $estado_siniestros = EstadoSiniestro::all();
        
        foreach ($estado_siniestros as $estado_siniestro) {
            foreach ($models as $model) {
                $model['estado_siniestro_id'] = $estado_siniestro->id;
                $model['user_id'] = 1;
                ColorSiniestro::create($model);    
            }
        }
    }
}
