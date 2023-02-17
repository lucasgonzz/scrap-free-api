<?php

namespace App\Http\Controllers;

use App\Models\Transportista;
use Illuminate\Http\Request;

class TransportistaController extends Controller
{
   
    public function index() {
        $models = Transportista::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Transportista::create([
            'num'                   => $this->num('transportistas'),
            'nombre'                => $request->nombre,
            'codigo'                => $request->codigo,
            'email'                 => $request->email,
            'telefono'              => $request->telefono,
            'notas'                 => $request->notas,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('Transportista', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Transportista::find($id);
        $model->nombre                = $request->nombre;
        $model->codigo                = $request->codigo;
        $model->email                 = $request->email;
        $model->telefono              = $request->telefono;
        $model->notas                 = $request->notas;
        $model->save();
        return response()->json(['model' => $this->fullModel('Transportista', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Transportista::find($id);
        $model->delete();
        return response(null, 200);
    }
}
