<?php

namespace Database\Seeders;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\SiniestroHelper;
use App\Models\Bien;
use App\Models\EstadoSiniestro;
use App\Models\FotoEstudioMercado;
use App\Models\Image;
use App\Models\NotaImportante;
use App\Models\Siniestro;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class SiniestroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (env('APP_ENV') == 'local') {
            $siniestros = [
                [
                    'asegurado'                     => 'Jorge Miguel',
                    'aseguradora_id'                => 1,
                    'asegurado_id'                  => 1,
                    'fecha_ocurrencia'              => Carbon::today()->subDays(4),
                    'fecha_denuncia'                => Carbon::today()->subDays(2),
                    'causa_siniestro_id'            => 1,
                    'estado_general_siniestro_id'   => null,
                    'estado_siniestro_id'           => null,
                    'telefono'                      => '3412649528',
                    'email'                         => 'lucasgonzalez210200@gmail.com',
                    'localidad_id'                  => 1,
                    'provincia_id'                  => 1,
                    'tipo_orden_de_servicio_id'     => 1,
                    'gestor_scrap_free_id'          => 1,
                    'gestor_aseguradora_id'         => 1,
                    'centro_reparacion_id'          => 1,
                    'foto_deposito_deducible'       => env('APP_URL').'/storage/factura_compra.jpg',
                    'poliza_id'                     => 1,
                    'ramo_id'                       => 1,
                    'user_id'                       => 1,
                    'notas_importantes'                 => 'Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible. Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible. Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible. Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible. Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible. Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible. Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible. Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible. Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible. Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible. Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible. Descripcion del hecho con notas importantes y muchas mas palabras como para rellenar el espacio y ver cuanto ocupa llevandolo al maximo posible.',
                    'descripcion_del_hecho'         => 'Descolgue el tv para pintar y se me cae de costado, cuando lo enciendo sólo se escuchaba el sonido',
                    'recomendacion'                 => 'Estas son algunas recomendaciones que hacemos sobre este siniestro para que puedan hacer algo al respecto. Estas son algunas recomendaciones que hacemos sobre este siniestro para que puedan hacer algo al respecto. Estas son algunas recomendaciones que hacemos sobre este siniestro para que puedan hacer algo al respecto. Estas son algunas recomendaciones que hacemos sobre este siniestro para que puedan hacer algo al respecto. Estas son algunas recomendaciones que hacemos sobre este siniestro para que puedan hacer algo al respecto. Estas son algunas recomendaciones que hacemos sobre este siniestro para que puedan hacer algo al respecto. Estas son algunas recomendaciones que hacemos sobre este siniestro para que puedan hacer algo al respecto. Estas son algunas recomendaciones que hacemos sobre este siniestro para que puedan hacer algo al respecto. Estas son algunas recomendaciones que hacemos sobre este siniestro para que puedan hacer algo al respecto.',
                    'cantidad_bienes'               => 3,
                    'comentarios_tecnico'           => 'Nuestros técnicos inspeccionaron el equipo y nos informan que tiene dañado el compresor, la causa del daño es producto de una fluctuación electromagnética.',
                    'posible_causa'                 => 'Fluctuación electromagnética y otro monton de cosas super complejas de explicar',
                    'fecha_informe_tecnico'         => Carbon::now()->subDays(3),
                ],
            ];

        } else {
            $siniestros = [
                [
                    'aseguradora_id'                => 1,
                    'asegurado'                     => 'Jorge Miguel',
                    'causa_siniestro_id'            => 1,
                    'estado_general_siniestro_id'   => null,
                    'estado_siniestro_id'           => null,
                    'telefono'                      => '3412649528',
                    'localidad_id'                  => 1,
                    'provincia_id'                  => 1,
                    'tipo_orden_de_servicio_id'     => 1,
                    'gestor_scrap_free_id'          => 1,
                    'gestor_aseguradora_id'         => 1,
                    'centro_reparacion_id'          => 1,
                    'foto_deposito_deducible'       => env('APP_URL').'/storage/factura_compra.jpg',
                    'user_id'                       => 1,
                ],
                [
                    'aseguradora_id'                => 2,
                    'asegurado'                     => 'Jorge Miguel',
                    'causa_siniestro_id'            => 2,
                    'estado_general_siniestro_id'   => null,
                    'estado_siniestro_id'           => null,
                    'localidad_id'                  => 2,
                    'provincia_id'                  => 1,
                    'tipo_orden_de_servicio_id'     => 2,
                    'gestor_scrap_free_id'          => 1,
                    'gestor_aseguradora_id'         => 1,
                    'centro_reparacion_id'          => 2,
                    'foto_deposito_deducible'       => env('APP_URL').'/storage/factura_compra.jpg',
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
                    'centro_reparacion_id'          => 1,
                    'foto_deposito_deducible'       => env('APP_URL').'/storage/factura_compra.jpg',
                    'user_id'                       => 1,
                ],
            ];
        }

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
                'fecha_compra'                          => '2023-01-08',
                // 'fecha_compra'                          => Carbon::now()->subMonths(14),
                'valor_reposicion_a_nuevo'              => 554999,
                // 'foto_estudio_mercado'                  => env('APP_URL').'/storage/tele.jpeg',
                'valor_reparacion'                      => 260800,

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
                'user_id'                               => 1,
            ],
            [
                'nombre'                                => 'Heladera',       
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
                'fecha_compra'                          => '2014-01-08',
                // 'fecha_compra'                          => Carbon::now()->subMonths(14),
                'valor_reposicion_a_nuevo'              => 1226399,
                // 'foto_estudio_mercado'                  => env('APP_URL').'/storage/tele.jpeg',
                // 'valor_reparacion'                      => 50,

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
                'user_id'                               => 1,
            ],
            [
                'nombre'                                => 'Licuadora electrica',       
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
                'fecha_compra'                          => '2014-01-08',
                // 'fecha_compra'                          => Carbon::now()->subMonths(14),
                'valor_reposicion_a_nuevo'              => 1226399,
                // 'foto_estudio_mercado'                  => env('APP_URL').'/storage/tele.jpeg',
                // 'valor_reparacion'                      => 50,

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
                'user_id'                               => 1,
            ],
            // [
            //     'nombre'                                => 'Heladera',       
            //     'causa_bien_id'                         => 2,
            //     'estado_bien_id'                        => 2,
            //     'linea_id'                              => 2,
            //     'sub_linea_id'                          => 6,
            //     'tecnico_asegurado_id'                  => 1,
            //     'tecnico_scrap_free_id'                 => 1,
            //     'logistica_id'                          => null,
            //     'accesorios'                            => 'Tiene la puerta floja',
            //     'tiene_base'                            => 0,
            //     'tiene_cable'                           => 1,
            //     'tiene_cargador'                        => 0,
            //     'tiene_control'                         => 0,
            //     'comentarios_tecnico'                   => 'Medio pelo la puerta, estaba floja antes de que llegue',
            //     'descripcion'                           => 'Es una heladera vieja pero anda bien',
            //     'fecha_compra'                          => Carbon::now()->subMonths(48),
            //     'valor_reposicion_a_nuevo'              => 200,

            //     // Hay que revisar si este es foto o cometario 
            //     'informe_tecnico_asegurado'             => 'El tecnico del asegurado dice que esta rota',
            //     'marca'                                 => 'Freezer',
            //     'modelo'                                => 'YHHH-223',
            //     'numero_serie'                          => '-',
            //     'notas'                                 => null,
            //     'pagado_tecnico'                        => null,
            //     'posible_causa_asegurado'               => null,
            //     'precisa_embalaje'                      => null,
            //     'presupuesto_monto_asegurado'           => null,
            //     'liquidacion_bien'                      => null,
            //     'liquidacion_deducible'                 => null,
            //     'liquidacion_paga_asegurado'            => null,
            //     'user_id'                               => 1,
            // ],
            // [
            //     'nombre'                                => 'Licuadora electrica',       
            //     'causa_bien_id'                         => 2,
            //     'estado_bien_id'                        => 2,
            //     'linea_id'                              => 2,
            //     'sub_linea_id'                          => 6,
            //     'tecnico_asegurado_id'                  => 1,
            //     'tecnico_scrap_free_id'                 => 1,
            //     'logistica_id'                          => null,
            //     'accesorios'                            => 'THubo un corte de luz y despues de eso no volvio a andar como lo hacia antes, una lastima.',
            //     'tiene_base'                            => 0,
            //     'tiene_cable'                           => 1,
            //     'tiene_cargador'                        => 0,
            //     'tiene_control'                         => 0,
            //     'comentarios_tecnico'                   => 'Medio pelo la puerta, estaba floja antes de que llegue',
            //     'descripcion'                           => 'Es una heladera vieja pero anda bien',
            //     'fecha_compra'                          => Carbon::now()->subMonths(80),
            //     'valor_reposicion_a_nuevo'              => 300,

            //     // Hay que revisar si este es foto o cometario 
            //     'informe_tecnico_asegurado'             => 'El tecnico del asegurado dice que esta rota',
            //     'marca'                                 => 'Freezer',
            //     'modelo'                                => 'YHHH-223',
            //     'numero_serie'                          => '-',
            //     'notas'                                 => null,
            //     'pagado_tecnico'                        => null,
            //     'posible_causa_asegurado'               => null,
            //     'precisa_embalaje'                      => null,
            //     'presupuesto_monto_asegurado'           => null,
            //     'liquidacion_bien'                      => null,
            //     'liquidacion_deducible'                 => null,
            //     'liquidacion_paga_asegurado'            => null,
            //     'user_id'                               => 1,
            // ],
        ];

        $estados_siniestro = EstadoSiniestro::orderBy('id', 'ASC')
                                            ->take(6)
                                            ->get();
        // $estados_siniestro = EstadoSiniestro::orderBy('id', 'ASC')->get();
        $dias = count($estados_siniestro);

        $ct = new Controller();
        $hours = count($estados_siniestro) * count($siniestros);
        foreach ($estados_siniestro as $estado_siniestro) {
                
            // Esta for es para que se creen mas de un siniestro por estado
            for ($i=0; $i < 1; $i++) { 
                foreach ($siniestros as $siniestro) {
                    $siniestro['numero_siniestro']              = '#'.rand(100000, 10000000);
                    $siniestro['gestor_scrap_free_id']          = rand(1,3);
                    $siniestro['dias_en_estado_siniestro']      = rand(1,7);
                    $siniestro['estado_general_siniestro_id']   = rand(1,3);
                    $siniestro['estado_siniestro_id']           = $estado_siniestro->id;
                    $siniestro['num']                           = $ct->num('siniestros');
                    $created_siniestro = Siniestro::create($siniestro);
                    $created_siniestro->created_at = Carbon::today()->subDays($dias)->subHours($hours);
                    $created_siniestro->save();
                    $dias--;

                    $this->setNotaImportantes($created_siniestro);

                    $total_dias = $estado_siniestro->id;
                    $total_dias++;
                    for ($estado_siniestro_id=1; $estado_siniestro_id <= $estado_siniestro->id; $estado_siniestro_id++) { 
                        SiniestroHelper::attachEstadoSiniestro($created_siniestro, $estado_siniestro_id, true, Carbon::now()->subDays($total_dias - $estado_siniestro_id));
                    }

                    $hours--;

                    if ($created_siniestro->id == 1) {
                        $_bienes = array_slice($bienes, 0, 1);
                    } else {
                        $_bienes = $bienes;
                    }

                    foreach ($_bienes as $bien) {
                        $bien['num'] = $ct->num('biens');
                        $bien['siniestro_id'] = $created_siniestro->id;
                        $bien['nombre'] .= ' con muchas cosas';
                        $created_bien = Bien::create($bien);
                        $this->bienImages($bien, $created_bien, $created_siniestro);
                        $this->bienCoberturas($bien, $created_bien);
                    }
                }
            }
        }
    }

    function bienCoberturas($bien, $created_bien) {
        if ($bien['nombre'] == 'Televisor con muchas cosas') {
            $coberturas = [
                [
                    'id'                => 1,
                    'suma_asegurada'    => 741318,
                    'deducible'         => null,
                ],
                [
                    'id'                => 2,
                    'suma_asegurada'    => 7413184,
                    'deducible'         => null,
                ],
            ];
        }
        // if ($bien['nombre'] == 'Televisor con muchas cosas') {
        //     $coberturas = [
        //         [
        //             'id'                => 1,
        //             'suma_asegurada'    => 200,
        //             'deducible'         => null,
        //         ],
        //     ];
        // }
        if ($bien['nombre'] == 'Heladera con muchas cosas') {
            $coberturas = [
                [
                    'id'                => 1,
                    'suma_asegurada'    => null,
                    'deducible'         => null,
                ],
                [
                    'id'                => 2,
                    'suma_asegurada'    => 200,
                    'deducible'         => 50,
                ],
            ];
        }
        if ($bien['nombre'] == 'Licuadora electrica con muchas cosas') {
            $coberturas = [
                [
                    'id'                => 2,
                    'suma_asegurada'    => null,
                    'deducible'         => null,
                ],
            ];
        }
        foreach ($coberturas as $cobertura) {
            $created_bien->coberturas()->attach($cobertura['id'], [
                'suma_asegurada'    => $cobertura['suma_asegurada'],
                'deducible'         => $cobertura['deducible'],
            ]);
        }
    }

    function bienImages($bien, $created_bien, $created_siniestro) {
        if ($bien['nombre'] == 'Televisor con muchas cosas') {
            $images = [
                env('APP_URL').'/storage/tele.jpeg',
                env('APP_URL').'/storage/tele2.jpg',
                env('APP_URL').'/storage/tele2.jpg',
            ];
        }
        if ($bien['nombre'] == 'Heladera con muchas cosas') {
            $images = [
                env('APP_URL').'/storage/heladera.jpg',
                env('APP_URL').'/storage/heladera2.jpg',
                env('APP_URL').'/storage/heladera2.jpg',
            ];
        }
        if ($bien['nombre'] == 'Licuadora electrica con muchas cosas') {
            $images = [
                env('APP_URL').'/storage/licuadora.jpg',
                env('APP_URL').'/storage/licuadora2.webp',
                env('APP_URL').'/storage/licuadora2.webp',
            ];
        }
        if ($created_siniestro->id == 2) {
            $images = array_slice($images, 0, 1);
        }

        foreach ($images as $image) {
            Image::create([
                'imageable_id'      => $created_bien->id,
                'imageable_type'    => 'bien',
                'image_url'         => $image,
            ]);

            // FotoEstudioMercado::create([
            //     'image_url'         => $image,
            //     'bien_id'           => $created_bien->id,
            // ]);
        }
    }

    function setNotaImportantes($siniestro) {
        $nota_importantes = [
            'Consulto si desea continuar con el tramite.',
            'Consulto con nuestro tecnico por el tv.',
            'Nuestro tecnico coordina inspeccion, el asegurado le informo que no lo tiene el al equipo, que esta en el tecnico y salió de vacaciones.',
            'Asegurada tenia el aire en el tecnico, solicitamos lo ponga a disposicion para inspeccion.',
            'Nuestro tecnico va a coordinar inspeccion',
            'El tecnico del aire lo inspecciona el el tv se inspecciona en nuestro servicio tecnico.',
            'Hay que inspeccionar TV reparado, Aire no reparado.',
            'Informo que debemos inspeccionar los equipos, desiste por el tramite del lavarropas, ya que no tiene ni informe, ni factura.',
            'No puede contactar al tecnico que reparo.',
            'CD enviada por mail',
            'Falta informes presentados correctamente, facturas de pago, inspeccion.',
            ' Enviar CD.',
            'Requiero presente informe con causa ya que nosotros no la podemos establecer si ya estan reparados.',
            'Informo una vez presentadas las facturas y los informes correctamente procederemos a inspeccionar los equipos.',
            'Solicito presente factura de compra de los equipos que ya abono.',
            'Informe del aire no tiene causa probable.',
             'Solicito presente correctamente.',
            'Informa que extravio el IT del lavarropas.',
            'Adjunto imagenes, falta etiqueta aire y del lavarropas, alega que no se ve el modelo y serie.',
            'Insisto por informacion.',
            'Solicito informacion para auditoria.',
            'Envio wp de protocolo, aguardo respuesta.',
            'Nota: 1er siniestro, denuncia daños en lavarropa, a/a y tv por fallas de tensión y/o corto circuito, por favor inspeccionar, determinar causa, en caso de que corresponda, intentar reparar, en caso contrario cerrar con orden Musimundo.',
        ];
        foreach ($nota_importantes as $nota_importante) {
            $model = [];
            $model['siniestro_id'] = $siniestro->id;
            $model['nota'] = $nota_importante;
            NotaImportante::create($model);
        }
    }
}
