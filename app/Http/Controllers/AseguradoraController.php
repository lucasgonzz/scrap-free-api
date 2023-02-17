<?php

namespace App\Http\Controllers;

use App\Models\Aseguradora;
use Illuminate\Http\Request;

class AseguradoraController extends Controller
{
   
    public function index() {
        $models = Aseguradora::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Aseguradora::create([
            'num'                   => $this->num('aseguradoras'),
            'nombre'                => $request->nombre,
            'direccion'             => $request->direccion,
            'contacto'              => $request->contacto,
            'nombre_contacto'       => $request->nombre_contacto,
            'notas'                 => $request->notas,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('Aseguradora', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Aseguradora::find($id);
        $model->nombre            = $request->nombre;
        $model->direccion         = $request->direccion;
        $model->contacto          = $request->contacto;
        $model->nombre_contacto   = $request->nombre_contacto;
        $model->notas             = $request->notas;
        $model->save();
        return response()->json(['model' => $this->fullModel('Aseguradora', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Aseguradora::find($id);
        $model->delete();
        return response(null);
    }
}
