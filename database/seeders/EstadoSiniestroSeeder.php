<?php

namespace Database\Seeders;

use App\Models\EstadoSiniestro;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EstadoSiniestroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            [
                'nombre' =>'Contactar Asegurado',
                'enviar_mensaje_function' => 'contactar_asegurado',
            ],
            [
                'nombre' =>'Colectar Informacion para Auditoria',
            ],
            [
                'nombre' =>'Colectar Informacion para Auditoria (CD Enviada)',
            ],
            [
                'nombre' =>'Evaluacion Auditoria',
            ],
            [
                'nombre' =>'Preparar Retiro',
            ],
            [
                'nombre' =>'Preparar Envio a SF (Asegurado)',
            ],
            [
                'nombre' =>'Coordinar Retiro Equipo',
            ],
            [
                'nombre' =>'Retiro Agendado',
            ],
            [
                'nombre' =>'En transito a Scrap Free',
            ],
            [
                'nombre' =>'Pendiente Inspeccion Tecnico',
            ],
            [
                'nombre' =>'Pendiente Informe Tecnico',
            ],
            [
                'nombre' =>'Reparacion (Siniestro aprobado)',
            ],
            [
                'nombre' =>'Coordinar Devolucion',
            ],
            [
                'nombre' =>'Devolucion Agendada',
            ],
            [
                'nombre' =>'En transito hacia asegurado',
            ],
            [
                'nombre' =>'Armar Liquidacion Asegurado',
                'por_defecto_en_estados_actualmente'    => 1,
            ],
            [
                'nombre' =>'Validar Liquidacion Asegurado',
                'por_defecto_en_estados_actualmente'    => 1,
            ],
            [
                'nombre' =>'Pendiente Conformidad (Reparacion * Pago)',
            ],
            [
                'nombre' =>'Pendiente Confirmacion Recibo equipo sin reparar',
            ],
            [
                'nombre' =>'Cierre Administrativo (Cargar en NOVA)',
                'por_defecto_en_estados_que_coinciden'  => 1,
                'por_defecto_en_estados_actualmente'    => 1,
            ],
            [
                'nombre' =>'Cierre Administartivo (Enviar a Life Seguros)',
                'por_defecto_en_estados_que_coinciden'  => 1,
                'por_defecto_en_estados_actualmente'    => 1,
            ],
            [
                'nombre' =>'Pendiente Cierre Administrativo de Sancor',
            ],
            [
                'nombre' =>'Pendiente Cierre Administrativo de Life',
            ],
            [
                'nombre' =>'En pausa * Otros (validar por que)',
            ],
            [
                'nombre' =>'Enviar Carta Documento',
            ],
            [
                'nombre' =>'Cerrado',
            ],
        ];

        $codigo = 1;
        $i = count($estados);
        foreach ($estados as $estado) {
            EstadoSiniestro::create([
                'num'           => $codigo,
                'codigo'        => $codigo,
                'nombre'        => $estado['nombre'],
                'enviar_mensaje_function'   => isset($estado['enviar_mensaje_function']) ? $estado['enviar_mensaje_function'] : 0,
                'por_defecto_en_estados_que_coinciden'   => isset($estado['por_defecto_en_estados_que_coinciden']) ? $estado['por_defecto_en_estados_que_coinciden'] : 0,
                'por_defecto_en_estados_actualmente'   => isset($estado['por_defecto_en_estados_actualmente']) ? $estado['por_defecto_en_estados_actualmente'] : 0,
                'user_id'       => 1,
                'created_at'    => Carbon::now()->subDays(6)->addHours($i),
            ]);
            $i--;
            $codigo++;
        }
    }
}
