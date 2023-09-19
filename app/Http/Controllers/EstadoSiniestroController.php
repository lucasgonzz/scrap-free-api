<?php

namespace App\Http\Controllers;

use App\Models\EstadoSiniestro;
use Illuminate\Http\Request;

class EstadoSiniestroController extends Controller
{
   
    public function index() {
        $models = EstadoSiniestro::where('user_id', $this->userId())
                            ->orderBy('codigo', 'ASC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = EstadoSiniestro::create([
            'num'                                   => $this->num('estado_siniestros'),
            'nombre'                                => $request->nombre,
            'codigo'                                => $request->codigo,
            'descripcion'                           => $request->descripcion,
            'por_defecto_en_estados_que_coinciden'  => $request->por_defecto_en_estados_que_coinciden,
            'por_defecto_en_estados_actualmente'    => $request->por_defecto_en_estados_actualmente,
            'user_id'                               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('EstadoSiniestro', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = EstadoSiniestro::find($id);
        $model->nombre                                  = $request->nombre;
        $model->codigo                                  = $request->codigo;
        $model->descripcion                             = $request->descripcion;
        $model->por_defecto_en_estados_que_coinciden    = $request->por_defecto_en_estados_que_coinciden;
        $model->por_defecto_en_estados_actualmente      = $request->por_defecto_en_estados_actualmente;
        $model->save();
        return response()->json(['model' => $this->fullModel('EstadoSiniestro', $model->id)], 200);
    }

    public function destroy($id) {
        $model = EstadoSiniestro::find($id);
        $model->delete();
        return response(null);
    }
}
