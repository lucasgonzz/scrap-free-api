<?php

namespace App\Http\Controllers;

use App\Models\EstadoBien;
use Illuminate\Http\Request;

class EstadoBienController extends Controller
{
   
    public function index() {
        $models = EstadoBien::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }
    
    public function store(Request $request) {
        $model = EstadoBien::create([
            'num'                   => $this->num('estado_biens'),
            'nombre'                => $request->nombre,
            'descripcion'           => $request->descripcion,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('EstadoBien', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = EstadoBien::find($id);
        $model->nombre                = $request->nombre;
        $model->descripcion           = $request->descripcion;
        $model->save();
        return response()->json(['model' => $this->fullModel('EstadoBien', $model->id)], 200);
    }

    public function destroy($id) {
        $model = EstadoBien::find($id);
        $model->delete();
        return response(null, 200);
    }
}
