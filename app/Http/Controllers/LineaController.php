<?php

namespace App\Http\Controllers;

use App\Models\Linea;
use Illuminate\Http\Request;

class LineaController extends Controller
{
   
    public function index() {
        $models = Linea::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Linea::create([
            'num'                   => $this->num('lineas'),
            'nombre'                => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('Linea', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Linea::find($id);
        $model->nombre                = $request->nombre;
        $model->save();
        return response()->json(['model' => $this->fullModel('Linea', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Linea::find($id);
        $model->delete();
        return response(null, 200);
    }
}
