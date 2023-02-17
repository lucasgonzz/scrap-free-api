<?php

namespace App\Http\Controllers;

use App\Models\CausaBien;
use Illuminate\Http\Request;

class CausaBienController extends Controller
{
   
    public function index() {
        $models = CausaBien::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = CausaBien::create([
            'num'                   => $this->num('causa_biens'),
            'nombre'                => $request->nombre,
            'descripcion'           => $request->descripcion,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('CausaBien', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = CausaBien::find($id);
        $model->nombre                = $request->nombre;
        $model->descripcion           = $request->descripcion;
        $model->save();
        return response()->json(['model' => $this->fullModel('CausaBien', $model->id)], 200);
    }

    public function destroy($id) {
        $model = CausaBien::find($id);
        $model->delete();
        return response(null, 200);
    }
}
