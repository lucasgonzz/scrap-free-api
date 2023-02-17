<?php

namespace App\Http\Controllers\CommonLaravel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\TwilioHelper;
use App\Mail\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{

    function sendVerificationCode(Request $request) {
        $user = User::where('email', $request->email)
                    ->first();
        if (is_null($user)) {
            return response()->json(['email_send' => false], 200);
        }
        $code = rand(100000, 999999);
        $user->verification_code = $code;
        $user->save();

        Mail::to($user)->send(new PasswordReset($code));
        return response()->json(['email_send' => true], 200);
    }

    function checkVerificationCode(Request $request) {
        $user = User::where('email', $request->email)
                        ->first();
        if ($user->verification_code == $request->verification_code) {
            return response()->json(['verified' => true], 200);
        }
        return response()->json(['verified' => false], 200);
    }

    function updatePassword(Request $request) {
        $user = User::where('email', $request->email)
                        ->first();
        $user->password = bcrypt($request->password);
        $user->save();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], false)) {
            return response()->json(['password_updated' => true], 200);
        }
    }

}
