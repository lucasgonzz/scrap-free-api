<?php

namespace App\Http\Controllers;

use App\Models\EstadoGeneralSiniestro;
use Illuminate\Http\Request;

class EstadoGeneralSiniestroController extends Controller
{
   
    public function index() {
        $models = EstadoGeneralSiniestro::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = EstadoGeneralSiniestro::create([
            'num'                   => $this->num('estado_general_siniestros'),
            'nombre'                => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('EstadoGeneralSiniestro', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = EstadoGeneralSiniestro::find($id);
        $model->nombre                = $request->nombre;
        $model->save();
        return response()->json(['model' => $this->fullModel('EstadoGeneralSiniestro', $model->id)], 200);
    }

    public function destroy($id) {
        $model = EstadoGeneralSiniestro::find($id);
        $model->delete();
        return response(null, 200);
    }
}
