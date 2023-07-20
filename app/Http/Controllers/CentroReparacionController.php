<?php

namespace App\Http\Controllers;

use App\Models\CentroReparacion;
use Illuminate\Http\Request;

class CentroReparacionController extends Controller
{

    public function index() {
        $models = CentroReparacion::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = CentroReparacion::create([
            'num'                   => $this->num('centro_reparacions'),
            'nombre'                  => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        $this->sendAddModelNotification('CentroReparacion', $model->id);
        return response()->json(['model' => $this->fullModel('CentroReparacion', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = CentroReparacion::find($id);
        $model->nombre                = $request->nombre;
        $model->save();
        $this->sendAddModelNotification('CentroReparacion', $model->id);
        return response()->json(['model' => $this->fullModel('CentroReparacion', $model->id)], 200);
    }

    public function destroy($id) {
        $model = CentroReparacion::find($id);
        $model->delete();
        return response(null);
    }
}
