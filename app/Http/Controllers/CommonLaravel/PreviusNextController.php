<?php

namespace App\Http\Controllers\CommonLaravel;

use App\Http\Controllers\CommonLaravel\Helpers\GeneralHelper;
use App\Http\Controllers\CommonLaravel\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreviusNextController extends Controller
{

    function previusNext($model_name, $index) {
        $model_name = GeneralHelper::getModelName($model_name);
        $models = $model_name::where('user_id', UserHelper::userId())
                        ->withAll()
                        ->orderBy('id', 'DESC')
                        ->take($index)
                        ->get();
        if (count($models) >= 1) {
            $model = $models[count($models)-1];
            return response()->json(['model' => $model]);
        }
        return response()->json(['model' => null]);
    }

    function getIndexPreviusNext($model_name, $id) {
        $model_name = GeneralHelper::getModelName($model_name);
        $model = $model_name::find($id);
        $models = $model_name::where('user_id', UserHelper::userId())
                        ->where('created_at', '>=', $model->created_at)
                        ->pluck('id');
        return response()->json(['index' => count($models)], 200);
    }

}
