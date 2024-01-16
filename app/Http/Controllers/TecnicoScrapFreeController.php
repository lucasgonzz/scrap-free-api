<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Models\TecnicoScrapFree;
use Illuminate\Http\Request;

class TecnicoScrapFreeController extends Controller
{

    public function index() {
        $models = TecnicoScrapFree::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = TecnicoScrapFree::create([
            'num'                   => $this->num('TecnicoScrapFree'),
            'name'                  => $request->name,
            'user_id'               => $this->userId(),
        ]);
        $this->sendAddModelNotification('TecnicoScrapFree', $model->id);
        return response()->json(['model' => $this->fullModel('TecnicoScrapFree', $model->id)], 201);
    }  

    public function show($id) {
        return response()->json(['model' => $this->fullModel('TecnicoScrapFree', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = TecnicoScrapFree::find($id);
        $model->name                = $request->name;
        $model->save();
        $this->sendAddModelNotification('TecnicoScrapFree', $model->id);
        return response()->json(['model' => $this->fullModel('TecnicoScrapFree', $model->id)], 200);
    }

    public function destroy($id) {
        $model = TecnicoScrapFree::find($id);
        ImageController::deleteModelImages($model);
        $model->delete();
        $this->sendDeleteModelNotification('TecnicoScrapFree', $model->id);
        return response(null);
    }
}
