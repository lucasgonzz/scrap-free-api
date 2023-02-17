<?php

namespace App\Http\Controllers;

use App\Models\UnidadNegocio;
use Illuminate\Http\Request;

class UnidadNegocioController extends Controller
{
   
    public function index() {
        $models = UnidadNegocio::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = UnidadNegocio::create([
            'num'                   => $this->num('unidad_negocios'),
            'nombre'                => $request->nombre,
            'aseguradora_id'        => $request->aseguradora_id,
            'email'                 => $request->email,
            'domicilio'             => $request->domicilio,
            'notas'                 => $request->notas,
            'responsable'           => $request->responsable,
            'telefono_conmutador'   => $request->telefono_conmutador,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('UnidadNegocio', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = UnidadNegocio::find($id);
        $model->nombre                = $request->nombre;
        $model->aseguradora_id        = $request->aseguradora_id;
        $model->email                 = $request->email;
        $model->domicilio             = $request->domicilio;
        $model->notas                 = $request->notas;
        $model->responsable           = $request->responsable;
        $model->telefono_conmutador   = $request->telefono_conmutador;
        $model->save();
        return response()->json(['model' => $this->fullModel('UnidadNegocio', $model->id)], 200);
    }

    public function destroy($id) {
        $model = UnidadNegocio::find($id);
        $model->delete();
        return response(null, 200);
    }
}
