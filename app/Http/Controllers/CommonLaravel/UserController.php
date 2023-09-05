<?php

namespace App\Http\Controllers\CommonLaravel;

use App\Http\Controllers\CommonLaravel\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function update(Request $request, $id) {
        $model = Auth()->user();
        $model->name = $request->name;
        $model->doc_number = $request->doc_number;
        $model->company_name = $request->company_name;
        $model->email = $request->email;
        $model->save();
        $model = UserHelper::getFullModel();
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

    function registerPayment($company_name) {
        $user = User::where('company_name', $company_name)->first();
        $user->payment_expired_at = $user->payment_expired_at->addMonth();
        $user->save();
        echo 'El proximo pago de '.$user->company_name.' vence el '.date_format($user->payment_expired_at, 'd/m/Y H:m:i');
    }

    function setLastActivity() {
        $user = Auth()->user();
        $user->last_activity = Carbon::now();
        $user->save();
        return response(null, 200);
    }
}
