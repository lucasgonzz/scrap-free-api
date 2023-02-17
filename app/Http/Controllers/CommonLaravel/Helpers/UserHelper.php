<?php

namespace App\Http\Controllers\CommonLaravel\Helpers;

use App\Models\User;
use Carbon\Carbon;

class UserHelper {
	
	static function userId($get_owner = true) {
        $user = Auth()->user();
        if (is_null($user) && env('APP_ENV') == 'local') {
            $user = User::where('company_name', 'Scrap Free')->first();
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

    static function getFullModel($get_owner = true) {
        $user = User::where('id', self::userId($get_owner))
                    ->withAll()
                    ->first();
        return $user;
    }

}