<?php

namespace App\Http\Controllers\CommonLaravel;

use App\Http\Controllers\CommonLaravel\Helpers\GeneralHelper;
use App\Http\Controllers\CommonLaravel\ImageController;
use App\Http\Controllers\CommonLaravel\SearchController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeleteController extends Controller
{
    function delete(Request $request, $model_name) {
        $models = [];
        $formated_model_name = GeneralHelper::getModelName($model_name);
        if ($request->from_filter) {
            $search_ct = new SearchController();
            $models = $search_ct->search($request, $model_name, $request->filter_form);
            Log::info('models from_filter:');
            foreach($models as $model) {
                Log::info($model->name);
            }
        } else {
            foreach ($request->models_id as $id) {
                $models[] = $formated_model_name::find($id);
            }
            Log::info('models from models_id:');
            foreach($models as $model) {
                Log::info($model->name);
            }
        }
        $models_response = [];
        foreach ($models as $model) {
            ImageController::deleteModelImages($model);
            $model->delete();
        }
        return response()->json(['models' => $models], 200);
    }
}
