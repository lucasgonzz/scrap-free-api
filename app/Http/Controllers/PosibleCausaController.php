<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Models\PosibleCausa;
use Illuminate\Http\Request;

class PosibleCausaController extends Controller
{

    public function index() {
        $models = PosibleCausa::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = PosibleCausa::create([
            'nombre'                  => $request->nombre,
            'user_id'               => $this->userId(),
        ]);
        // $this->sendAddModelNotification('PosibleCausa', $model->id);
        return response()->json(['model' => $this->fullModel('PosibleCausa', $model->id)], 201);
    }  

    public function show($id) {
        return response()->json(['model' => $this->fullModel('PosibleCausa', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = PosibleCausa::find($id);
        $model->nombre                = $request->nombre;
        $model->save();
        // $this->sendAddModelNotification('PosibleCausa', $model->id);
        return response()->json(['model' => $this->fullModel('PosibleCausa', $model->id)], 200);
    }

    public function destroy($id) {
        $model = PosibleCausa::find($id);
        $model->delete();
        $this->sendDeleteModelNotification('PosibleCausa', $model->id);
        return response(null);
    }
}
