<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
   
    public function index() {
        $models = Provincia::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Provincia::create([
            'num'                   => $this->num('provincias'),
            'nombre'                => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('Provincia', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Provincia::find($id);
        $model->nombre                = $request->nombre;
        $model->save();
        return response()->json(['model' => $this->fullModel('Provincia', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Provincia::find($id);
        $model->delete();
        return response(null);
    }
}
