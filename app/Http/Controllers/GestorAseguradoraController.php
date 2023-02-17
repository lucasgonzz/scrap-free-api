<?php

namespace App\Http\Controllers;

use App\Models\GestorAseguradora;
use Illuminate\Http\Request;

class GestorAseguradoraController extends Controller
{
   
    public function index() {
        $models = GestorAseguradora::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = GestorAseguradora::create([
            'num'                   => $this->num('gestor_aseguradoras'),
            'nombre'                => $request->nombre,
            'celular'               => $request->celular,
            'telefono'              => $request->telefono,
            'email'                 => $request->email,
            'unidad_negocio_id'     => $request->unidad_negocio_id,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('GestorAseguradora', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = GestorAseguradora::find($id);
        $model->nombre                = $request->nombre;
        $model->celular               = $request->celular;
        $model->telefono              = $request->telefono;
        $model->email                 = $request->email;
        $model->unidad_negocio_id     = $request->unidad_negocio_id;
        $model->save();
        return response()->json(['model' => $this->fullModel('GestorAseguradora', $model->id)], 200);
    }

    public function destroy($id) {
        $model = GestorAseguradora::find($id);
        $model->delete();
        return response(null, 200);
    }
}
