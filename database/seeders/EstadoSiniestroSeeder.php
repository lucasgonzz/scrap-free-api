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
        $nombres = [
            'Contactar Asegurado',
            'Colectar Informacion para Auditoria',
            'Colectar Informacion para Auditoria (CD Enviada)',
            'Evaluacion Auditoria',
            'Preparar Retiro',
            'Preparar Envio a SF (Asegurado)',
            'Coordinar Retiro Equipo',
            'Retiro Agendado',
            'En transito a Scrap Free',
            'Pendiente Inspeccion Tecnico',
            'Pendiente Informe Tecnico',
            'Reparacion (Siniestro aprobado)',
            'Coordinar Devolucion',
            'Devolucion Agendada',
            'En transito hacia asegurado',
            'Armar Liquidacion Asegurado',
            'Validar Liquidacion Asegurado',
            'Pendiente Conformidad (Reparacion * Pago)',
            'Pendiente Confirmacion Recibo equipo sin reparar',
            'Cierre Administrativo (Cargar en NOVA)',
            'Cierre Administartivo (Enviar a Life Seguros)',
            'Pendiente Cierre Administrativo de Sancor',
            'Pendiente Cierre Administrativo de Life',
            'En pausa * Otros (validar por que)',
            'Enviar Carta Documento',
            'Cerrado',
        ];
        $descripciones = [
            'Hacer Contacto (urgente!).',
            'Pedir Documentos sobre Siniestro',
            'Liquidar a los 70 dias',
            'Validar Documentos para ver si le pagan o se pide el equipo',
            'Ver si asegurado embala, puede llevarlo a un transporte/deposito, lo puede enviar por encomienda o si lo retiramos desde su casa. Luego avisar a Romi.',
            'Coordinar el asegurado que lo envie a Scrap Free',
            'Coordinar con transportista que lo pasen a buscar',
            'Dar seguimiento con transporte para ver cuando pasan a retirar equipo.',
            'Dar seguimiento con transporte para ver donde esta el equipo.',
            'Inspeccion Agendada',
            'Armar informe tecnico, cuadrar con liquidacion.',
            'Reparar equipo.',
            'Equipo listo para ser devuelto, coordinar con transporte y avisar al asegurado.',
            'Dar seguimiento con transporte para ver cuando pasan a retirar equipo.',
            'Dar seguimiento con transporte para ver donde esta el equipo.',
            'Armar Liquidacion para el asegurado',
            'Validar la liquidacion armada para el asegurado',
            'Pedir conformidad de reparacion del equipo o bien que firme el recibo liberatorio con el CBU para que le puedan pagar.',
            'Validar que se recibio el equipo y firme recepcion o de el ok a que recibio el equipo.',
            'Cargar Pack de Documentacion en sistema Nova.',
            'Enviar Siniestro a Life Seguros para facturar',
            'Validar con Gestor Liquidacion y datos.',
            'Validar con Life si se puede facturar',
            'Dar Seguimiento para ver que paso y que tiene que pasar para cambiarlo de estado.',
            'Enviar Carta documento al gestor',
            'CERRADO!',
        ];

        $codigo = 1;
        for ($i=0; $i < count($nombres) ; $i++) { 
            EstadoSiniestro::create([
                'num'           => $codigo,
                'codigo'        => $codigo,
                'nombre'        => $nombres[$i],
                'descripcion'   => $descripciones[$i],
                'user_id'       => 1,
                'created_at'    => Carbon::now()->subDays(6)->addHours($i),
            ]);
            $codigo++;
        }
    }
}
