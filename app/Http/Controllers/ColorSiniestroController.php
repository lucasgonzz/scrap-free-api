<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Models\ColorSiniestro;
use Illuminate\Http\Request;

class ColorSiniestroController extends Controller
{

    public function index() {
        $models = ColorSiniestro::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = ColorSiniestro::create([
            'name'                          => $request->name,
            'estado_siniestro_id'           => $request->estado_siniestro_id,
            'dias_estado_siniestro_min'     => $request->dias_estado_siniestro_min,
            'dias_estado_siniestro_max'     => $request->dias_estado_siniestro_max,
            'user_id'                       => $this->userId(),
        ]);
        $this->sendAddModelNotification('ColorSiniestro', $model->id);
        return response()->json(['model' => $this->fullModel('ColorSiniestro', $model->id)], 201);
    }  

    public function show($id) {
        return response()->json(['model' => $this->fullModel('ColorSiniestro', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = ColorSiniestro::find($id);
        $model->name                          = $request->name;
        $model->estado_siniestro_id           = $request->estado_siniestro_id;
        $model->dias_estado_siniestro_min     = $request->dias_estado_siniestro_min;
        $model->dias_estado_siniestro_max     = $request->dias_estado_siniestro_max;
        $model->save();
        $this->sendAddModelNotification('ColorSiniestro', $model->id);
        return response()->json(['model' => $this->fullModel('ColorSiniestro', $model->id)], 200);
    }

    public function destroy($id) {
        $model = ColorSiniestro::find($id);
        ImageController::deleteModelImages($model);
        $model->delete();
        $this->sendDeleteModelNotification('ColorSiniestro', $model->id);
        return response(null);
    }
}
