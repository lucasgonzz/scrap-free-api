<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Models\TecnicoAsegurado;
use Illuminate\Http\Request;

class TecnicoAseguradoController extends Controller
{

    public function index() {
        $models = TecnicoAsegurado::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = TecnicoAsegurado::create([
            'num'                   => $this->num('TecnicoAsegurado'),
            'name'                  => $request->name,
            'user_id'               => $this->userId(),
        ]);
        $this->sendAddModelNotification('TecnicoAsegurado', $model->id);
        return response()->json(['model' => $this->fullModel('TecnicoAsegurado', $model->id)], 201);
    }  

    public function show($id) {
        return response()->json(['model' => $this->fullModel('TecnicoAsegurado', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = TecnicoAsegurado::find($id);
        $model->name                = $request->name;
        $model->save();
        $this->sendAddModelNotification('TecnicoAsegurado', $model->id);
        return response()->json(['model' => $this->fullModel('TecnicoAsegurado', $model->id)], 200);
    }

    public function destroy($id) {
        $model = TecnicoAsegurado::find($id);
        ImageController::deleteModelImages($model);
        $model->delete();
        $this->sendDeleteModelNotification('TecnicoAsegurado', $model->id);
        return response(null);
    }
}
