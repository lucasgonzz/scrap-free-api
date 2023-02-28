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
            'cuit'                          => $request->cuit,
            'numero_asociado'               => $request->numero_asociado,
            'user_id'                       => $this->userId(),
        ]);
        // PolizaHelper::attachCoberturas($model, $request->coberturas);
        GeneralHelper::attachModels($model, 'coberturas', $request->coberturas, ['deducible', 'deducible_en_pesos', 'monto_minimo', 'suma_asegurada']);
        return response()->json(['model' => $this->fullModel('Poliza', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Poliza::find($id);
        $model->asegurado_id                    = $request->asegurado_id;
        $model->numero_poliza                   = $request->numero_poliza;
        $model->tipo_producto_de_seguro_id      = $request->tipo_producto_de_seguro_id;
        $model->ramo_id                         = $request->ramo_id;
        $model->referencia                      = $request->referencia;
        $model->cuit                            = $request->cuit;
        $model->numero_asociado                 = $request->numero_asociado;
        $model->save();
        GeneralHelper::attachModels($model, 'coberturas', $request->coberturas, ['deducible', 'deducible_en_pesos', 'monto_minimo', 'suma_asegurada']);
        // PolizaHelper::attachCoberturas($model, $request->coberturas);
        return response()->json(['model' => $this->fullModel('Poliza', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Poliza::find($id);
        $model->delete();
        return response(null, 200);
    }
}
