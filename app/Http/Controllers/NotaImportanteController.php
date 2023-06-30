<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Models\NotaImportante;
use Illuminate\Http\Request;

class NotaImportanteController extends Controller
{

    public function index() {
        $models = NotaImportante::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = NotaImportante::create([
            'nota'                  => $request->nota,
            'temporal_id'           => $this->getTemporalId($request),
            'siniestro_id'          => $request->model_id,
        ]);
        return response()->json(['model' => $this->fullModel('NotaImportante', $model->id)], 201);
    }  

    public function show($id) {
        return response()->json(['model' => $this->fullModel('NotaImportante', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = NotaImportante::find($id);
        $model->nota                = $request->nota;
        $model->save();
        return response()->json(['model' => $this->fullModel('NotaImportante', $model->id)], 200);
    }

    public function destroy($id) {
        $model = NotaImportante::find($id);
        ImageController::deleteModelImages($model);
        $model->delete();
        return response(null);
    }
}
