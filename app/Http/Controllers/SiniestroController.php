<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Http\Controllers\Helpers\SiniestroHelper;
use App\Models\Siniestro;
use Illuminate\Http\Request;

class SiniestroController extends Controller
{
   
    public function index() {
        $models = Siniestro::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->paginate(25);
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Siniestro::create([
            'num'                               => $this->num('siniestros'),
            'aseguradora_id'                    => $request->aseguradora_id,
            'asegurado_id'                      => $request->asegurado_id,
            'causa_siniestro_id'                => $request->causa_siniestro_id,
            'estado_siniestro_id'               => $request->estado_siniestro_id,
            'estado_general_siniestro_id'       => $request->estado_general_siniestro_id,
            'localidad_id'                      => $request->localidad_id,
            'provincia_id'                      => $request->provincia_id,
            'tipo_orden_de_servicio_id'         => $request->tipo_orden_de_servicio_id,
            'gestor_scrap_free_id'              => $request->gestor_scrap_free_id,
            'gestor_aseguradora_id'             => $request->gestor_aseguradora_id,
            'codigo_postal'                     => $request->codigo_postal,
            'comentarios_seguro'                => $request->comentarios_seguro,
            'costo_reporte'                     => $request->costo_reporte,
            'denunciante'                       => $request->denunciante,
            'foto_deposito_deducible'           => $request->foto_deposito_deducible,
            'domicilio_completo_google'         => $request->domicilio_completo_google,
            'domicilio_completo_google_lat'     => $request->domicilio_completo_google_lat,
            'domicilio_completo_google_lng'     => $request->domicilio_completo_google_lng,
            'descripcion_bien'                  => $request->descripcion_bien,
            'entre_calles'                      => $request->entre_calles,
            'fecha_alta_scrap_free'             => $request->fecha_alta_scrap_free,
            'fecha_cierre_administrativo'       => $request->fecha_cierre_administrativo,
            'fecha_cierre_aseguradora'          => $request->fecha_cierre_aseguradora,
            'fecha_cierre_scrap_free'           => $request->fecha_cierre_scrap_free,
            'fecha_denuncia'                    => $request->fecha_denuncia,
            'fecha_ocurrencia'                  => $request->fecha_ocurrencia,
            'liquidacion_deducible'             => $request->liquidacion_deducible,
            'liquidacion_siniestro'             => $request->liquidacion_siniestro,
            'notas_domicilio'                   => $request->notas_domicilio,
            'orden_servicio'                    => $request->orden_servicio,
            'recomendacion'                     => $request->recomendacion,
            'reparacion_deducible'              => $request->reparacion_deducible,
            'reparacion_paga_asegurado'         => $request->reparacion_paga_asegurado,
            'reparacion_siniestro'              => $request->reparacion_siniestro,
            'numero_siniestro'                  => $request->numero_siniestro,
            'poliza_id'                         => $request->poliza_id,
            'centro_reparacion_id'              => $request->centro_reparacion_id,
            'user_id'                           => $this->userId(),
        ]);
        SiniestroHelper::attachEstadoSiniestro($model, $request->estado_siniestro_id, true);
        $this->updateRelationsCreated('siniestro', $model->id, $request->childrens);
        $this->sendAddModelNotification('Siniestro', $model->id);
        return response()->json(['model' => $this->fullModel('Siniestro', $model->id)], 201);
    }  

    public function show($id) {
        return response()->json(['model' => $this->fullModel('Siniestro', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = Siniestro::find($id);
        SiniestroHelper::attachEstadoSiniestro($model, $request->estado_siniestro_id);
        $model->aseguradora_id                  = $request->aseguradora_id;
        $model->asegurado_id                    = $request->asegurado_id;
        $model->causa_siniestro_id              = $request->causa_siniestro_id;
        $model->estado_siniestro_id             = $request->estado_siniestro_id;
        $model->estado_general_siniestro_id     = $request->estado_general_siniestro_id;
        $model->localidad_id                    = $request->localidad_id;
        $model->provincia_id                    = $request->provincia_id;
        $model->tipo_orden_de_servicio_id       = $request->tipo_orden_de_servicio_id;
        $model->gestor_scrap_free_id            = $request->gestor_scrap_free_id;
        $model->gestor_aseguradora_id           = $request->gestor_aseguradora_id;
        $model->codigo_postal                   = $request->codigo_postal;
        $model->comentarios_seguro              = $request->comentarios_seguro;
        $model->costo_reporte                   = $request->costo_reporte;
        $model->denunciante                     = $request->denunciante;
        $model->foto_deposito_deducible         = $request->foto_deposito_deducible;
        $model->domicilio_completo_google       = $request->domicilio_completo_google;
        $model->domicilio_completo_google_lat   = $request->domicilio_completo_google_lat;
        $model->domicilio_completo_google_lng   = $request->domicilio_completo_google_lng;
        $model->descripcion_bien                = $request->descripcion_bien;
        $model->entre_calles                    = $request->entre_calles;
        $model->fecha_alta_scrap_free           = $request->fecha_alta_scrap_free;
        $model->fecha_cierre_administrativo     = $request->fecha_cierre_administrativo;
        $model->fecha_cierre_aseguradora        = $request->fecha_cierre_aseguradora;
        $model->fecha_cierre_scrap_free         = $request->fecha_cierre_scrap_free;
        $model->fecha_denuncia                  = $request->fecha_denuncia;
        $model->fecha_ocurrencia                = $request->fecha_ocurrencia;
        $model->liquidacion_deducible           = $request->liquidacion_deducible;
        $model->liquidacion_siniestro           = $request->liquidacion_siniestro;
        $model->notas_domicilio                 = $request->notas_domicilio;
        $model->orden_servicio                  = $request->orden_servicio;
        $model->recomendacion                   = $request->recomendacion;
        $model->reparacion_deducible            = $request->reparacion_deducible;
        $model->reparacion_paga_asegurado       = $request->reparacion_paga_asegurado;
        $model->reparacion_siniestro            = $request->reparacion_siniestro;
        $model->numero_siniestro                = $request->numero_siniestro;
        $model->poliza_id                       = $request->poliza_id;
        $model->centro_reparacion_id            = $request->centro_reparacion_id;
        $model->save();
        $this->sendAddModelNotification('Siniestro', $model->id);
        return response()->json(['model' => $this->fullModel('Siniestro', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Siniestro::find($id);
        ImageController::deleteModelImages($model);
        $this->sendDeleteModelNotification('Siniestro', $model->id);
        $model->delete();
        return response(null);
    }
}
