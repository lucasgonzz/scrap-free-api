<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
   
    public function index() {
        $models = Tecnico::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Tecnico::create([
            'num'                   => $this->num('tecnicos'),
            'nombre'                => $request->nombre,
            'direccion'             => $request->direccion,
            'notas'                 => $request->notas,
            'telefono_celular'      => $request->telefono_celular,
            'telefono_fijo'         => $request->telefono_fijo,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('Tecnico', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Tecnico::find($id);
        $model->nombre                = $request->nombre;
        $model->direccion             = $request->direccion;
        $model->notas                 = $request->notas;
        $model->telefono_celular      = $request->telefono_celular;
        $model->telefono_fijo         = $request->telefono_fijo;
        $model->save();
        return response()->json(['model' => $this->fullModel('Tecnico', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Tecnico::find($id);
        $model->delete();
        return response(null, 200);
    }
}
