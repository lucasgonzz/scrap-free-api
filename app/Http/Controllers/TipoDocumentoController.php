<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{

    public function index() {
        $models = TipoDocumento::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = TipoDocumento::create([
            'num'                   => $this->num('TipoDocumento'),
            'nombre'                => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        $this->sendAddModelNotification('TipoDocumento', $model->id);
        return response()->json(['model' => $this->fullModel('TipoDocumento', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = TipoDocumento::find($id);
        $model->nombre                = $request->nombre;
        $model->save();
        $this->sendAddModelNotification('TipoDocumento', $model->id);
        return response()->json(['model' => $this->fullModel('TipoDocumento', $model->id)], 200);
    }

    public function destroy($id) {
        $model = TipoDocumento::find($id);
        $model->delete();
        return response(null);
    }
}
