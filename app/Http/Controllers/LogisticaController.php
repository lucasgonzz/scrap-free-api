<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\LogisticaHelper;
use App\Models\Logistica;
use Illuminate\Http\Request;

class LogisticaController extends Controller
{
   
    public function index() {
        $models = Logistica::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Logistica::create([
            'num'                                   => $this->num('logisticas'),
            'siniestro_id'                          => $request->model_id,
            'temporal_id'                           => $this->getTemporalId($request),
            'transportista_retiro_id'               => $request->transportista_retiro_id,
            'costo_flete_devolucion'                => $request->costo_flete_devolucion,
            'costo_flete_ida'                       => $request->costo_flete_ida,
            'fecha_cobro_flete_ida'                 => $request->fecha_cobro_flete_ida,
            'domicilio_devolucion'                  => $request->domicilio_devolucion,
            'domicilio_retiro'                      => $request->domicilio_retiro,
            'fecha_entrega_asegurado'               => $request->fecha_entrega_asegurado,
            'fecha_entrega_scrap_free'              => $request->fecha_entrega_scrap_free,
            'fecha_estimada_entrega_asegurado'      => $request->fecha_estimada_entrega_asegurado,
            'fecha_estimada_entrega_scrap_free'     => $request->fecha_estimada_entrega_scrap_free,
            'fecha_estimada_retiro_asegurado'       => $request->fecha_estimada_retiro_asegurado,
            'fecha_estimada_retiro_scrap_free'      => $request->fecha_estimada_retiro_scrap_free,
            'fecha_pedido_retiro_asegurado'         => $request->fecha_pedido_retiro_asegurado,
            'fecha_pedido_retiro_scrap_free'        => $request->fecha_pedido_retiro_scrap_free,
            'fecha_retiro_asegurado'                => $request->fecha_retiro_asegurado,
            'fecha_retiro_scrap_free'               => $request->fecha_retiro_scrap_free,
            'flete_otros_costos'                    => $request->flete_otros_costos,
            'notas_transportista_devolucion'        => $request->notas_transportista_devolucion,
            'notas_transportista_retiro'            => $request->notas_transportista_retiro,
            'user_id'                               => $this->userId(),
        ]);
        LogisticaHelper::setBienes($model, $request->bienes);
        return response()->json(['model' => $this->fullModel('Logistica', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Logistica::find($id);
        $model->transportista_devolucion_id           = $request->transportista_devolucion_id;
        $model->transportista_retiro_id               = $request->transportista_retiro_id;
        $model->costo_flete_devolucion                = $request->costo_flete_devolucion;
        $model->costo_flete_ida                       = $request->costo_flete_ida;
        $model->fecha_cobro_flete_ida                 = $request->fecha_cobro_flete_ida;
        $model->domicilio_devolucion                  = $request->domicilio_devolucion;
        $model->domicilio_retiro                      = $request->domicilio_retiro;
        $model->fecha_entrega_asegurado               = $request->fecha_entrega_asegurado;
        $model->fecha_entrega_scrap_free              = $request->fecha_entrega_scrap_free;
        $model->fecha_estimada_entrega_asegurado      = $request->fecha_estimada_entrega_asegurado;
        $model->fecha_estimada_entrega_scrap_free     = $request->fecha_estimada_entrega_scrap_free;
        $model->fecha_estimada_retiro_asegurado       = $request->fecha_estimada_retiro_asegurado;
        $model->fecha_estimada_retiro_scrap_free      = $request->fecha_estimada_retiro_scrap_free;
        $model->fecha_pedido_retiro_asegurado         = $request->fecha_pedido_retiro_asegurado;
        $model->fecha_pedido_retiro_scrap_free        = $request->fecha_pedido_retiro_scrap_free;
        $model->fecha_retiro_asegurado                = $request->fecha_retiro_asegurado;
        $model->fecha_retiro_scrap_free               = $request->fecha_retiro_scrap_free;
        $model->flete_otros_costos                    = $request->flete_otros_costos;
        $model->notas_transportista_devolucion        = $request->notas_transportista_devolucion;
        $model->notas_transportista_retiro            = $request->notas_transportista_retiro;
        $model->save();
        LogisticaHelper::setBienes($model, $request->bienes);
        return response()->json(['model' => $this->fullModel('Logistica', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Logistica::find($id);
        $model->delete();
        return response(null, 200);
    }
}
