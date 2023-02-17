<?php

namespace App\Http\Controllers;

use App\Models\Cobertura;
use Illuminate\Http\Request;

class CoberturaController extends Controller
{
   
    public function index() {
        $models = Cobertura::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Cobertura::create([
            'num'                   => $this->num('coberturas'),
            'nombre'                => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('Cobertura', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Cobertura::find($id);
        $model->nombre             = $request->nombre;
        $model->save();
        return response()->json(['model' => $this->fullModel('Cobertura', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Cobertura::find($id);
        $model->delete();
        return response(null, 200);
    }
}
