<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\Helpers\GeneralHelper;
use App\Models\Bien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BienController extends Controller
{
   
    public function index() {
        $models = Bien::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Bien::create([
            'num'                                   => $this->num('biens'),
            'nombre'                                => $request->nombre,
            'estado_bien_id'                        => $request->estado_bien_id,
            'causa_bien_id'                         => $request->causa_bien_id,
            'linea_id'                              => $request->linea_id,
            'sub_linea_id'                          => $request->sub_linea_id,
            'tecnico_asegurado_id'                  => $request->tecnico_asegurado_id,
            'tecnico_scrap_free_id'                 => $request->tecnico_scrap_free_id,
            'logistica_id'                          => $request->logistica_id,
            'siniestro_id'                          => $request->model_id,
            // 'temporal_id'                           => $this->getTemporalId($request),
            'accesorios'                            => $request->accesorios,
            'tiene_base'                            => $request->tiene_base,
            'tiene_cable'                           => $request->tiene_cable,
            'tiene_cargador'                        => $request->tiene_cargador,
            'tiene_control'                         => $request->tiene_control,
            'comentarios_tecnico'                   => $request->comentarios_tecnico,
            'descripcion'                           => $request->descripcion,
            'foto_factura_compra_asegurado'         => $request->foto_factura_compra_asegurado,    
            'foto_factura_tecnico_asegurado'        => $request->foto_factura_tecnico_asegurado,        
            'foto_factura_tecnico_scrap_free'       => $request->foto_factura_tecnico_scrap_free,        
            'fecha_compra'                          => $request->fecha_compra,
            'foto_adicional_asegurado'              => $request->foto_adicional_asegurado,       
            'foto_atras_asegurado'                  => $request->foto_atras_asegurado,       
            'foto_atras_tecnico_scrap_free'         => $request->foto_atras_tecnico_scrap_free,       
            'foto_evidencia_scrap_free'             => $request->foto_evidencia_scrap_free,   
            'foto_frente_asegurado'                 => $request->foto_frente_asegurado,
            'foto_frente_tecnico_scrap_free'        => $request->foto_frente_tecnico_scrap_free,   
            'foto_etiqueta'                         => $request->foto_etiqueta,   
            'foto_captura_de_pantalla'              => $request->foto_captura_de_pantalla,   
            'informe_tecnico_asegurado'             => $request->informe_tecnico_asegurado,  
            'marca'                                 => $request->marca,
            'modelo'                                => $request->modelo,
            'numero_serie'                          => $request->numero_serie,
            'notas'                                 => $request->notas,
            'pagado_tecnico'                        => $request->pagado_tecnico,
            'posible_causa_asegurado'               => $request->posible_causa_asegurado,  
            'precisa_embalaje'                      => $request->precisa_embalaje,
            'presupuesto_monto_asegurado'           => $request->presupuesto_monto_asegurado,      
            'liquidacion_bien'                      => $request->liquidacion_bien,
            'liquidacion_deducible'                 => $request->liquidacion_deducible,
            'liquidacion_paga_asegurado'            => $request->liquidacion_paga_asegurado,  
            'valor_reposicion_a_nuevo'              => $request->valor_reposicion_a_nuevo,
            'valor_reparacion'                      => $request->valor_reparacion,
            'usar_el_valor_de_indemnizacion'        => $request->usar_el_valor_de_indemnizacion,
            'foto_estudio_mercado'                  => $request->foto_estudio_mercado,
            'user_id'                               => $this->userId(),
        ]);
        $this->updateRelationsCreated('bien', $model->id, $request->childrens);

        GeneralHelper::attachModels($model, 'coberturas', $request->coberturas, ['suma_asegurada', 'deducible']);

        return response()->json(['model' => $this->fullModel('Bien', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        Log::info('bien update request:');
        Log::info($request);
        $model = Bien::find($id);
        $model->nombre                                = $request->nombre;
        $model->estado_bien_id                        = $request->estado_bien_id;
        $model->causa_bien_id                         = $request->causa_bien_id;
        $model->linea_id                              = $request->linea_id;
        $model->sub_linea_id                          = $request->sub_linea_id;
        $model->tecnico_asegurado_id                  = $request->tecnico_asegurado_id;
        $model->tecnico_scrap_free_id                 = $request->tecnico_scrap_free_id;
        $model->logistica_id                          = $request->logistica_id;
        $model->siniestro_id                          = $request->siniestro_id;
        $model->accesorios                            = $request->accesorios;
        $model->tiene_base                            = $request->tiene_base;
        $model->tiene_cable                           = $request->tiene_cable;
        $model->tiene_cargador                        = $request->tiene_cargador;
        $model->tiene_control                         = $request->tiene_control;
        $model->comentarios_tecnico                   = $request->comentarios_tecnico;
        $model->descripcion                           = $request->descripcion;
        $model->foto_factura_compra_asegurado         = $request->foto_factura_compra_asegurado;    
        $model->foto_factura_tecnico_asegurado        = $request->foto_factura_tecnico_asegurado;        
        $model->foto_factura_tecnico_scrap_free       = $request->foto_factura_tecnico_scrap_free;        
        $model->fecha_compra                          = $request->fecha_compra;
        $model->foto_adicional_asegurado              = $request->foto_adicional_asegurado;       
        $model->foto_atras_asegurado                  = $request->foto_atras_asegurado;       
        $model->foto_atras_tecnico_scrap_free         = $request->foto_atras_tecnico_scrap_free;       
        $model->foto_evidencia_scrap_free             = $request->foto_evidencia_scrap_free;   
        $model->foto_frente_asegurado                 = $request->foto_frente_asegurado;
        $model->foto_frente_tecnico_scrap_free        = $request->foto_frente_tecnico_scrap_free;          
        $model->informe_tecnico_asegurado             = $request->informe_tecnico_asegurado;  
        $model->marca                                 = $request->marca;
        $model->modelo                                = $request->modelo;
        $model->numero_serie                          = $request->numero_serie;
        $model->notas                                 = $request->notas;
        $model->pagado_tecnico                        = $request->pagado_tecnico;
        $model->posible_causa_asegurado               = $request->posible_causa_asegurado;  
        $model->precisa_embalaje                      = $request->precisa_embalaje;
        $model->presupuesto_monto_asegurado           = $request->presupuesto_monto_asegurado;      
        $model->liquidacion_bien                      = $request->liquidacion_bien;
        $model->liquidacion_deducible                 = $request->liquidacion_deducible;
        $model->liquidacion_paga_asegurado            = $request->liquidacion_paga_asegurado;  
        $model->valor_reposicion_a_nuevo              = $request->valor_reposicion_a_nuevo;
        $model->valor_reparacion                      = $request->valor_reparacion;
        $model->foto_estudio_mercado                  = $request->foto_estudio_mercado;
        $model->usar_el_valor_de_indemnizacion        = $request->usar_el_valor_de_indemnizacion;
        $model->save();

        GeneralHelper::attachModels($model, 'coberturas', $request->coberturas, ['suma_asegurada', 'deducible']);
        
        return response()->json(['model' => $this->fullModel('Bien', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Bien::find($id);
        $model->delete();
        return response(null, 200);
    }
}
