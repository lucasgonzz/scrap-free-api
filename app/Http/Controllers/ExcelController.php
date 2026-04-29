<?php

namespace App\Http\Controllers;

use App\Exports\MetricasExport;
use App\Models\Siniestro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class ExcelController extends Controller
{
    function metricas($inicio, $fin, $aseguradora_id, $gestores_id) {

        $array_gestores_id = explode('-', $gestores_id);

        $inicioCarbon = Carbon::parse($inicio);
        $finCarbon = Carbon::parse($fin);

        Log::info('inicioCarbon: '.$inicioCarbon->format('d/m/y'));
        Log::info('finCarbon: '.$finCarbon->format('d/m/y'));

        
        $siniestros = Siniestro::whereBetween('fecha_ocurrencia', [$inicioCarbon, $finCarbon])
                        ->where('aseguradora_id', $aseguradora_id)
                        ->whereIn('gestor_aseguradora_id', $array_gestores_id)
                        ->where('estado_siniestro_id', 22)
                        ->orderBy('fecha_ocurrencia', 'DESC')
                        ->get();

        return Excel::download(new MetricasExport($siniestros), 'metricas'.date_format(Carbon::now(), 'd-m-y H:m').'.xlsx');
    }
}
