<?php

namespace App\Http\Controllers\CommonLaravel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonLaravel\Helpers\GeneralHelper;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    function setImage(Request $request, $prop_name) {
        Log::info('prop_name: '.$prop_name);
        $model_name = GeneralHelper::getModelName($request->model_name);
        
        $name = Storage::disk('public')->put('', $request->image_url);

        if (env('APP_ENV') == 'local') {
            $name = env('APP_URL').'/storage/'.$name;
        } else {
            $name = env('APP_URL').'/public/storage/'.$name;
        }

        $model = $model_name::find($request->id);
        if ($prop_name == 'has_many') {
            $image = Image::create([
                'image_url'         => $name,
                'imageable_id'      => $model->id,
                'imageable_type'    => $request->model_name,
            ]);
        } else {
            $this->deleteImageProp($request->model_name, $request->id, $prop_name);
            $model->{$prop_name} = $name;
            $model->save();
        }
        
        return response()->json(['model' => $this->fullModel($request->model_name, $request->id)], 200);
    }

    function deleteImageProp($_model_name, $id, $prop_name = 'image_url') {
        $model_name = GeneralHelper::getModelName($_model_name);
        $model = $model_name::find($id);
        if (!is_null($model->{$prop_name})) {
            Storage::disk('public')->delete($model->{$prop_name});
        }
        $model->{$prop_name} = null;
        $model->save();
        return response()->json(['model' => $this->fullModel($_model_name, $id)], 200);
    }

    function deleteImageModel($model_name, $model_id, $image_id) {
        $image = Image::find($image_id);
        Storage::disk('public')->delete($image->image_url);
        $image->delete();
        return response()->json(['model' => $this->fullModel($model_name, $model_id)], 200);
    }
}
