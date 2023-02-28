<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\Helpers\GeneralHelper;
use App\Models\User;
use App\Notifications\AddedModel;
use App\Notifications\DeletedModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function userId($from_owner = true, $user_id = null) {
        if (!is_null($user_id)) {
            return $user_id;
        }
        $user = Auth()->user();
        if (is_null($user)) {
            return 1;
        }
        if ($from_owner) {
            if (is_null($user->owner_id)) {
                return $user->id;
            } else {
                return $user->owner_id;
            }
        } else {
            return $user->id;
        }
    }

    function user() {
        return User::find($this->userId());
    }

    function sendAddModelNotification($model_name, $model_id) {
        Auth()->user()->notify(new AddedModel($model_name, $model_id));
    }

    function sendDeleteModelNotification($model_name, $model_id) {
        Auth()->user()->notify(new DeletedModel($model_name, $model_id));
    }

    function getModelBy($table, $prop_name, $prop_value, $from_user = false, $prop_to_return = null, $return_0 = false) {
        $model = DB::table($table)
                    ->where($prop_name, $prop_value);
        if ($from_user) {
            $model = $model->where('user_id', $this->userId());
        }
        $model = $model->first();
        if (!is_null($model) && !is_null($prop_to_return)) {
            return $model->{$prop_to_return};
        } 
        if ($return_0) {
            return 0;
        }
        return $model;
    }

    function num($table, $user_id = null) {
        $last = DB::table($table)
                    ->where('user_id', $this->userId(true, $user_id))
                    ->orderBy('num', 'DESC')
                    ->first();
        if (is_null($last) || is_null($last->num)) {
            return 1;
        }
        return $last->num + 1;
    }

    function createIfNotExist($table, $prop_name, $prop_value, $data_to_insert, $from_user = true) {
        $model = DB::table($table)
                    ->where($prop_name, $prop_value);
        if ($from_user) {
            $model = $model->where('user_id', $this->userId());
        }
        $model = $model->first();
        if (is_null($model)) {
            DB::table($table)->insert($data_to_insert);
        }
    }

    function fullModel($model_name, $id) {
        $model_name = GeneralHelper::getModelName($model_name);
        $model = $model_name::where('id', $id)
                        ->withAll()
                        ->first();
        return $model;
    }
}
