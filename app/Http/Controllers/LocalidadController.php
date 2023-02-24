<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
   
    public function index() {
        $models = Localidad::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Localidad::create([
            'num'                   => $this->num('localidads'),
            'nombre'                => $request->nombre,
            'codigo_postal'         => $request->codigo_postal,
            'provincia_id'          => $request->provincia_id,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('Localidad', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Localidad::find($id);
        $model->nombre                = $request->nombre;
        $model->codigo_postal         = $request->codigo_postal;
        $model->provincia_id          = $request->provincia_id;
        $model->save();
        return response()->json(['model' => $this->fullModel('Localidad', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Localidad::find($id);
        $model->delete();
        return response(null);
    }
}
