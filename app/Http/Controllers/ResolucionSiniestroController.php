<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Models\ResolucionSiniestro;
use Illuminate\Http\Request;

class ResolucionSiniestroController extends Controller
{

    public function index() {
        $models = ResolucionSiniestro::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = ResolucionSiniestro::create([
            'nombre'                  => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        // $this->sendAddModelNotification('ResolucionSiniestro', $model->id);
        return response()->json(['model' => $this->fullModel('ResolucionSiniestro', $model->id)], 201);
    }  

    public function show($id) {
        return response()->json(['model' => $this->fullModel('ResolucionSiniestro', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = ResolucionSiniestro::find($id);
        $model->nombre                = $request->nombre;
        $model->save();
        // $this->sendAddModelNotification('ResolucionSiniestro', $model->id);
        return response()->json(['model' => $this->fullModel('ResolucionSiniestro', $model->id)], 200);
    }

    public function destroy($id) {
        $model = ResolucionSiniestro::find($id);
        $model->delete();
        $this->sendDeleteModelNotification('ResolucionSiniestro', $model->id);
        return response(null);
    }
}
