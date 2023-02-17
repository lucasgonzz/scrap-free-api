<?php

namespace App\Http\Controllers;

use App\Models\HonorarioLiquidacion;
use Illuminate\Http\Request;

class HonorarioLiquidacionController extends Controller
{
   
    public function index() {
        $models = HonorarioLiquidacion::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = HonorarioLiquidacion::create([
            'num'                                   => $this->num('honorario_liquidacions'),
            'aseguradora_id'                        => $request->aseguradora_id,
            'fecha_efectiva_honorarios_gestion'     => $request->fecha_efectiva_honorarios_gestion,
            'honorarios_gestion'                    => $request->honorarios_gestion,
            'notas'                                 => $request->notas,
            'user_id'                               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('HonorarioLiquidacion', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = HonorarioLiquidacion::find($id);
        $model->aseguradora_id                        = $request->aseguradora_id;
        $model->fecha_efectiva_honorarios_gestion     = $request->fecha_efectiva_honorarios_gestion;
        $model->honorarios_gestion                    = $request->honorarios_gestion;
        $model->notas                                 = $request->notas;
        $model->save();
        return response()->json(['model' => $this->fullModel('HonorarioLiquidacion', $model->id)], 200);
    }

    public function destroy($id) {
        $model = HonorarioLiquidacion::find($id);
        $model->delete();
        return response(null, 200);
    }
}
