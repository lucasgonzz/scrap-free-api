<?php

namespace App\Http\Controllers;

use App\Models\TipoOrdenDeServicio;
use Illuminate\Http\Request;

class TipoOrdenDeServicioController extends Controller
{
   
    public function index() {
        $models = TipoOrdenDeServicio::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = TipoOrdenDeServicio::create([
            'num'                   => $this->num('tipo_orden_de_servicios'),
            'nombre'                => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('TipoOrdenDeServicio', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = TipoOrdenDeServicio::find($id);
        $model->nombre                = $request->nombre;
        $model->save();
        return response()->json(['model' => $this->fullModel('TipoOrdenDeServicio', $model->id)], 200);
    }

    public function destroy($id) {
        $model = TipoOrdenDeServicio::find($id);
        $model->delete();
        return response(null, 200);
    }
}
