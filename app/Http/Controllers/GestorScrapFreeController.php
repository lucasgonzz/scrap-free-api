<?php

namespace App\Http\Controllers;

use App\Models\GestorScrapFree;
use Illuminate\Http\Request;

class GestorScrapFreeController extends Controller
{
   
    public function index() {
        $models = GestorScrapFree::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = GestorScrapFree::create([
            'num'                   => $this->num('gestor_scrap_frees'),
            'nombre'                => $request->nombre,
            'nombre_formal'         => $request->nombre_formal,
            'svg'                   => $request->svg,
            'celular'               => $request->celular,
            'telefono'              => $request->telefono,
            'email'                 => $request->email,
            'unidad_negocio_id'     => $request->unidad_negocio_id,
            'user_id'               => $this->userId(),
        ]);
        $this->sendAddModelNotification('Gestor-Scrap-Free', $model->id, false);
        return response()->json(['model' => $this->fullModel('GestorScrapFree', $model->id)], 201);
    }  

    function show($id) {
        return response()->json(['model' => $this->fullModel('GestorScrapFree', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = GestorScrapFree::find($id);
        $model->nombre                = $request->nombre;
        $model->nombre_formal         = $request->nombre_formal;
        $model->celular               = $request->celular;
        $model->svg                   = $request->svg;
        $model->telefono              = $request->telefono;
        $model->email                 = $request->email;
        $model->unidad_negocio_id     = $request->unidad_negocio_id;
        $model->save();
        $this->sendAddModelNotification('Gestor-Scrap-Free', $model->id, false);
        return response()->json(['model' => $this->fullModel('GestorScrapFree', $model->id)], 200);
    }

    public function destroy($id) {
        $model = GestorScrapFree::find($id);
        $model->delete();
        return response(null, 200);
    }
}
