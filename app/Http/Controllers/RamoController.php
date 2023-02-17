<?php

namespace App\Http\Controllers;

use App\Models\Ramo;
use Illuminate\Http\Request;

class RamoController extends Controller
{
   
    public function index() {
        $models = Ramo::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Ramo::create([
            'num'                   => $this->num('ramos'),
            'nombre'                => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('Ramo', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Ramo::find($id);
        $model->nombre                = $request->nombre;
        $model->save();
        return response()->json(['model' => $this->fullModel('Ramo', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Ramo::find($id);
        $model->delete();
        return response(null, 200);
    }
}
