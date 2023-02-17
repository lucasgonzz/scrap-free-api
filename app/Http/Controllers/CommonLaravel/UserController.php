<?php

namespace App\Http\Controllers\CommonLaravel;

use App\Http\Controllers\CommonLaravel\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function user() {
        return response()->json(['user' => UserHelper::getFullModel(false)], 200);
    }

    function update(Request $request, $id) {
        $model = Auth()->user();
        $model->name = $request->name;
        $model->doc_number = $request->doc_number;
        $model->company_name = $request->company_name;
        $model->email = $request->email;
        $model->save();
        return response()->json(['model' => $model], 200);
    }

    function updatePassword(Request $request) {
        if (Hash::check($request->current_password, Auth()->user()->password)) {
            $user = User::find(Auth()->user()->id);
            $user->update([
                'password' => bcrypt($request->new_password),
            ]);
            return response()->json(['updated' => true], 200);
        } else {
            return response()->json(['updated' => false], 200);
        }
    }
}
