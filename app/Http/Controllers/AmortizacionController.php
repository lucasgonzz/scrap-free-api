<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Models\Amortizacion;
use Illuminate\Http\Request;

class AmortizacionController extends Controller
{

    public function index() {
        $models = Amortizacion::orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Amortizacion::create([
            'anos'                  => $request->anos,
            'depreciacion'          => $request->depreciacion,
            'aseguradora_id'        => $request->aseguradora_id,
        ]);
        $this->sendAddModelNotification('Amortizacion', $model->id);
        return response()->json(['model' => $this->fullModel('Amortizacion', $model->id)], 201);
    }  

    public function show($id) {
        return response()->json(['model' => $this->fullModel('Amortizacion', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = Amortizacion::find($id);
        $model->anos                  = $request->anos;
        $model->depreciacion          = $request->depreciacion;
        $model->aseguradora_id        = $request->aseguradora_id;
        $model->save();
        $this->sendAddModelNotification('Amortizacion', $model->id);
        return response()->json(['model' => $this->fullModel('Amortizacion', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Amortizacion::find($id);
        ImageController::deleteModelImages($model);
        $model->delete();
        $this->sendDeleteModelNotification('Amortizacion', $model->id);
        return response(null);
    }
}
