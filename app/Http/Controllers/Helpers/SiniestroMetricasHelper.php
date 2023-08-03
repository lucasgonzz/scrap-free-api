<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\CommonLaravel\Helpers\UserHelper;
use App\Models\EstadoSiniestro;
use App\Models\Siniestro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SiniestroMetricasHelper {
	
	static function casosPorDia($from_date, $until_date, $estados_coinciden_id, $estados_actualmente_id) {
        $siniestros = Siniestro::where('user_id', UserHelper::userId())
                            ->whereDate('created_at', '>=', $from_date)
                            ->whereDate('created_at', '<=', $until_date)
                            ->orderBy('created_at', 'DESC')
                            ->get();
        
        $casos_por_dia_result = [];
        $casos_coinciden_estado_result = [];

        $start = Carbon::createFromFormat('Y-m-d', $from_date)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $until_date)->startOfDay();
        
        while ($start->lte($end)) {
            $casos_por_dia = [
                'created_at'        => $start->toFormattedDateString(),
                'siniestros_count'  => 0,
            ];

            $casos_coinciden_estado = [
                'created_at'        => $start->toFormattedDateString(),
                'siniestros_count'  => 0,
            ];

        	foreach ($siniestros as $siniestro) {
        		if ($siniestro->created_at->startOfDay()->eq($start)) {
        			$casos_por_dia['siniestros_count']++;
        		}

                foreach ($siniestro->estado_siniestros as $estado_siniestro) {
                    if ($estado_siniestro->pivot->created_at->startOfDay()->eq($start)) {
                        foreach ($estados_coinciden_id as $estado_id) {
                            if ($estado_id == $estado_siniestro->id) {
                                $casos_coinciden_estado['siniestros_count']++;
                            }
                        }
                    }
                }
        	}

            if ($casos_por_dia['siniestros_count'] > 0) {
                $casos_por_dia_result[] = $casos_por_dia;
            }

            if ($casos_coinciden_estado['siniestros_count'] > 0) {
                $casos_coinciden_estado_result[] = $casos_coinciden_estado;
            }

        	$start->addDay();
        }          



        return [
            'casos_por_dia'                             => $casos_por_dia_result,
            'casos_que_coinciden_con_estados'           => $casos_coinciden_estado_result,
            'casos_que_estan_actualmente_en_estados'    => Self::getEstadosActualmente($estados_actualmente_id)
        ];
	}

    static function getEstadosActualmente($estados_actualmente_id) {
        $results = [];
        foreach ($estados_actualmente_id as $estado_actualmente_id) {
            $siniestros = Siniestro::where('user_id', UserHelper::userId())
                                    ->where('estado_siniestro_id', $estado_actualmente_id)
                                    ->pluck('id');
            $results[] = [
                'estado_siniestro'  => EstadoSiniestro::find($estado_actualmente_id)->nombre,
                'siniestros_count'  => count($siniestros),
            ];
        } 
        return $results;
    }

}