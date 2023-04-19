<?php

namespace App\Http\Controllers\CommonLaravel\Helpers;

use App\Models\User;
use Carbon\Carbon;

class UserHelper {
	
	static function userId($get_owner = true) {
        $user = Auth()->user();
        if (is_null($user) && env('APP_ENV') == 'local') {
            $user = User::where('company_name', env('DEFAULT_COMPANY_NAME'))->first();
            return $user->id;
        }
        if ($get_owner) {
            if (is_null($user->owner_id)) {
                return $user->id;
            } else {
    	        return $user->owner_id;
            }
        } else {
            return $user->id;
        }
    }

    static function user() {
        return User::find(Self::userId());
    }

    static function getFullModel($get_owner = true) {
        $user = User::where('id', self::userId($get_owner))
                    ->withAll()
                    ->first();
        $user = Self::setEmployeeProps($user);
        return $user;
    }

    static function setEmployeeProps($user) {
        if (!is_null($user->owner_id)) {
            if (class_exists('App\Http\Controllers\Helpers\AuthHelper')) {
                $auth_helper = new \App\Http\Controllers\Helpers\AuthHelper();
                if (method_exists($auth_helper, 'setEmployeeProps')) {
                    $user = $auth_helper->setEmployeeProps($user);
                }
            } 
        }
        return $user;
    }

}