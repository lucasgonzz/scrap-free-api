<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\CommonLaravel\Helpers\UserHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AuthHelper {
	
	function setEmployeeProps($user) {
		$owner = UserHelper::getFullModel();
		$user->owner_extencions = $owner->extencions;
		$user->owner_configuration = $owner->configuration;
		$user->iva_included = $owner->iva_included;
		$user->ask_amount_in_vender = $owner->ask_amount_in_vender;
		$user->owner = $owner;
		return $user;
	}

	function checkUserLastActivity() {
		$user = Auth()->user();
		if (is_null($user->last_activity) || is_null($user->session_id) || $this->ya_paso_el_tiempo($user)) {
			session(['session_id' => time().rand(0,1000)]);
			$user->last_activity = Carbon::now();
			$user->session_id = session('session_id');
			$user->save();
			Log::info('se puso session_id: '.$user->session_id);
			return true;
		} else if ($user->session_id == session('session_id')) {
			Log::info('tiene el mismo session_id: '.$user->session_id);
			return true;
		}
		return false;
	}

	function ya_paso_el_tiempo($user) {
		if (Carbon::now()->subMinutes(env('USER_ACTIVITY_MINUTES'))->gte($user->last_activity)) {
			Log::info('Ya paso el tiempo');
			return true;
		} else {
			Log::info('No ha paso el tiempo');
		}
		return false;
	}

	function removeUserLastActivity($user) {
		$user->last_activity = Carbon::now()->subMinutes(env('USER_ACTIVITY_MINUTES'));
		Log::info('se puso last_activity en '.Carbon::now()->subMinutes(env('USER_ACTIVITY_MINUTES')));
		$user->save();
	}

}