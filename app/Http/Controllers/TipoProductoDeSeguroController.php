<?php

namespace App\Http\Controllers;

use App\Models\TipoProductoDeSeguro;
use Illuminate\Http\Request;

class TipoProductoDeSeguroController extends Controller
{
   
    public function index() {
        $models = TipoProductoDeSeguro::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = TipoProductoDeSeguro::create([
            'num'                   => $this->num('tipo_producto_de_seguros'),
            'nombre'                => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('TipoProductoDeSeguro', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = TipoProductoDeSeguro::find($id);
        $model->nombre                = $request->nombre;
        $model->save();
        return response()->json(['model' => $this->fullModel('TipoProductoDeSeguro', $model->id)], 200);
    }

    public function destroy($id) {
        $model = TipoProductoDeSeguro::find($id);
        $model->delete();
        return response(null, 200);
    }
}
