<?php

namespace Database\Seeders;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\SiniestroHelper;
use App\Models\Bien;
use App\Models\EstadoSiniestro;
use App\Models\Siniestro;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SiniestroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siniestros = [
            [
                'aseguradora_id'                => 1,
                'causa_siniestro_id'            => 1,
                'estado_general_siniestro_id'   => null,
                'estado_siniestro_id'           => null,
                'localidad_id'                  => 1,
                'provincia_id'                  => 1,
                'tipo_orden_de_servicio_id'     => 1,
                'gestor_scrap_free_id'          => 1,
                'gestor_aseguradora_id'         => 1,
                'user_id'                       => 1,
            ],
            [
                'aseguradora_id'                => 2,
                'causa_siniestro_id'            => 2,
                'estado_general_siniestro_id'   => null,
                'estado_siniestro_id'           => null,
                'localidad_id'                  => 2,
                'provincia_id'                  => 1,
                'tipo_orden_de_servicio_id'     => 2,
                'gestor_scrap_free_id'          => 1,
                'gestor_aseguradora_id'         => 1,
                'user_id'                       => 1,
            ],
            [
                'aseguradora_id'                => 2,
                'causa_siniestro_id'            => 3,
                'estado_general_siniestro_id'   => null,
                'estado_siniestro_id'           => null,
                'localidad_id'                  => 2,
                'provincia_id'                  => 1,
                'tipo_orden_de_servicio_id'     => 2,
                'gestor_scrap_free_id'          => 1,
                'gestor_aseguradora_id'         => 1,
                'user_id'                       => 1,
            ],
        ];

        $bienes = [
            [
                'nombre'                                => 'Televisor',       
                'causa_bien_id'                         => 1,
                'estado_bien_id'                        => 1,
                'linea_id'                              => 1,
                'sub_linea_id'                          => 1,
                'tecnico_asegurado_id'                  => 1,
                'tecnico_scrap_free_id'                 => 1,
                'logistica_id'                          => null,
                'accesorios'                            => 'Tiene una bolsita',
                'tiene_base'                            => 1,
                'tiene_cable'                           => 1,
                'tiene_cargador'                        => 0,
                'tiene_control'                         => 1,
                'comentarios_tecnico'                   => 'No tengo nada que decir sobre este televisor',
                'descripcion'                           => 'Es un tele bastante lindo y comodo de usar',
                'foto_factura_compra_asegurado'         => env('APP_URL').'/storage/factura_compra.jpg',
                'foto_factura_tecnico_asegurado'        => env('APP_URL').'/storage/factura_tecnico.jpg',
                'foto_factura_tecnico_scrap_free'       => null,
                'fecha_compra'                          => null,
                'foto_adicional_asegurado'              => null,
                'foto_atras_asegurado'                  => null,
                'foto_atras_tecnico_scrap_free'         => null,
                'foto_evidencia_scrap_free'             => null,
                'foto_frente_asegurado'                 => env('APP_URL').'/storage/televisor.jpg',
                'foto_frente_tecnico_scrap_free'        => env('APP_URL').'/storage/televisor_frente.jpg',

                // Hay que revisar si este es foto o cometario 
                'informe_tecnico_asegurado'             => 'El tecnico del asegurado dice que esta quemado',
                'marca'                                 => 'Samsung',
                'modelo'                                => 'MA33-4',
                'numero_serie'                          => '22234212',
                'notas'                                 => null,
                'pagado_tecnico'                        => null,
                'posible_causa_asegurado'               => null,
                'precisa_embalaje'                      => null,
                'presupuesto_monto_asegurado'           => null,
                'liquidacion_bien'                      => null,
                'liquidacion_deducible'                 => null,
                'liquidacion_paga_asegurado'            => null,
                'valor_reposicion_a_nuevo'              => null,
                'user_id'                               => 1,
            ],
            [
                'nombre'                                => 'Heladera',       
                'causa_bien_id'                         => 2,
                'estado_bien_id'                        => 2,
                'linea_id'                              => 2,
                'sub_linea_id'                          => 6,
                'tecnico_asegurado_id'                  => 1,
                'tecnico_scrap_free_id'                 => 1,
                'logistica_id'                          => null,
                'accesorios'                            => 'Tiene la puerta floja',
                'tiene_base'                            => 0,
                'tiene_cable'                           => 1,
                'tiene_cargador'                        => 0,
                'tiene_control'                         => 0,
                'comentarios_tecnico'                   => 'Medio pelo la puerta, estaba floja antes de que llegue',
                'descripcion'                           => 'Es una heladera vieja pero anda bien',
                'foto_factura_compra_asegurado'         => env('APP_URL').'/storage/factura_compra.jpg',
                'foto_factura_tecnico_asegurado'        => env('APP_URL').'/storage/factura_tecnico.jpg',
                'foto_factura_tecnico_scrap_free'       => null,
                'fecha_compra'                          => null,
                'foto_adicional_asegurado'              => null,
                'foto_atras_asegurado'                  => null,
                'foto_atras_tecnico_scrap_free'         => null,
                'foto_evidencia_scrap_free'             => null,
                'foto_frente_asegurado'                 => env('APP_URL').'/storage/heladera.jpg',
                'foto_frente_tecnico_scrap_free'        => env('APP_URL').'/storage/heladera_frente.jpg',

                // Hay que revisar si este es foto o cometario 
                'informe_tecnico_asegurado'             => 'El tecnico del asegurado dice que esta rota',
                'marca'                                 => 'Freezer',
                'modelo'                                => 'YHHH-223',
                'numero_serie'                          => '-',
                'notas'                                 => null,
                'pagado_tecnico'                        => null,
                'posible_causa_asegurado'               => null,
                'precisa_embalaje'                      => null,
                'presupuesto_monto_asegurado'           => null,
                'liquidacion_bien'                      => null,
                'liquidacion_deducible'                 => null,
                'liquidacion_paga_asegurado'            => null,
                'valor_reposicion_a_nuevo'              => null,
                'user_id'                               => 1,
            ],
        ];

        $estados_siniestro = EstadoSiniestro::all();
        $ct = new Controller();
        $hours = count($estados_siniestro) * count($siniestros);
        foreach ($estados_siniestro as $estado_siniestro) {
            foreach ($siniestros as $siniestro) {
                $siniestro['estado_general_siniestro_id']   = rand(1,3);
                $siniestro['estado_siniestro_id']   = $estado_siniestro->id;
                $siniestro['num']                   = $ct->num('siniestros');
                $siniestro = Siniestro::create($siniestro);
                $siniestro->created_at = Carbon::now()->subHours($hours);
                $siniestro->save();
                SiniestroHelper::attachEstadoSiniestro($siniestro, $estado_siniestro->id, true);
                $hours--;
                foreach ($bienes as $bien) {
                    $bien['num'] = $ct->num('biens');
                    $bien['siniestro_id'] = $siniestro->id;
                    $bien['nombre'] .= ' del siniestro num° '.$siniestro->num;
                    Bien::create($bien);
                }
            }
        }
    }
}
