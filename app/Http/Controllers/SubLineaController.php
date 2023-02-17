<?php

namespace App\Http\Controllers;

use App\Models\SubLinea;
use Illuminate\Http\Request;

class SubLineaController extends Controller
{
   
    public function index() {
        $models = SubLinea::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = SubLinea::create([
            'num'                   => $this->num('sub_lineas'),
            'nombre'                => $request->nombre,
            'linea_id'              => $request->linea_id,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('SubLinea', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = SubLinea::find($id);
        $model->nombre                = $request->nombre;
        $model->linea_id              = $request->linea_id;
        $model->save();
        return response()->json(['model' => $this->fullModel('SubLinea', $model->id)], 200);
    }

    public function destroy($id) {
        $model = SubLinea::find($id);
        $model->delete();
        return response(null, 200);
    }
}
