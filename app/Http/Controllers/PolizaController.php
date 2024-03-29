<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\Helpers\GeneralHelper;
use App\Http\Controllers\Helpers\PolizaHelper;
use App\Models\Poliza;
use Illuminate\Http\Request;

class PolizaController extends Controller
{
   
    public function index() {
        $models = Poliza::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Poliza::create([
            'num'                           => $this->num('polizas'),
            'asegurado_id'                  => $request->asegurado_id,
            'numero_poliza'                 => $request->numero_poliza,
            'tipo_producto_de_seguro_id'    => $request->tipo_producto_de_seguro_id,
            'ramo_id'                       => $request->ramo_id,
            'referencia'                    => $request->referencia,
            'tipo_documento_id'             => $request->tipo_documento_id,
            'numero_documento'              => $request->numero_documento,
            'numero_asociado'               => $request->numero_asociado,
            'user_id'                       => $this->userId(),
        ]);
        // PolizaHelper::attachCoberturas($model, $request->coberturas);
        GeneralHelper::attachModels($model, 'coberturas', $request->coberturas, ['cobertura', 'deducible']);
        return response()->json(['model' => $this->fullModel('Poliza', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Poliza::find($id);
        $model->asegurado_id                    = $request->asegurado_id;
        $model->numero_poliza                   = $request->numero_poliza;
        $model->tipo_producto_de_seguro_id      = $request->tipo_producto_de_seguro_id;
        $model->ramo_id                         = $request->ramo_id;
        $model->referencia                      = $request->referencia;
        $model->tipo_documento_id               = $request->tipo_documento_id;
        $model->numero_documento                = $request->numero_documento;
        $model->numero_asociado                 = $request->numero_asociado;
        $model->save();
        GeneralHelper::attachModels($model, 'coberturas', $request->coberturas, ['cobertura', 'deducible']);
        // PolizaHelper::attachCoberturas($model, $request->coberturas);
        return response()->json(['model' => $this->fullModel('Poliza', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Poliza::find($id);
        $model->delete();
        return response(null, 200);
    }
}
