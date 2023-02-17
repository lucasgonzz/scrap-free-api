<?php

namespace App\Http\Controllers;

use App\Models\CausaSiniestro;
use Illuminate\Http\Request;

class CausaSiniestroController extends Controller
{
   
    public function index() {
        $models = CausaSiniestro::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = CausaSiniestro::create([
            'num'                   => $this->num('causa_siniestros'),
            'nombre'                => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('CausaSiniestro', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = CausaSiniestro::find($id);
        $model->nombre                = $request->nombre;
        $model->save();
        return response()->json(['model' => $this->fullModel('CausaSiniestro', $model->id)], 200);
    }

    public function destroy($id) {
        $model = CausaSiniestro::find($id);
        $model->delete();
        return response(null);
    }
}
