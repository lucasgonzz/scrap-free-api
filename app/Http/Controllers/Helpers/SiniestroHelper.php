<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\BienController;
use App\Models\Siniestro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SiniestroHelper {
	
	static function attachEstadoSiniestro($model, $estado_siniestro_id, $from_store = false, $created_at = null) {
		if (is_null($created_at)) {
			$created_at = Carbon::now();
		}
		if ($from_store || $model->estado_siniestro_id != $estado_siniestro_id) {
			Log::info('user:');
			Log::info(is_null(Auth()->user()));
			if (!is_null(Auth()->user())) {
				$employee_id = Auth()->user()->id;
			} else {
				$employee_id = rand(1,3);
			}
			$model->estado_siniestros()->attach($estado_siniestro_id, [
				'created_at'	=> $created_at,
				'employee_id'	=> $employee_id,
			]);
			$model = Siniestro::find($model->id);
			$count = count($model->estado_siniestros);
			Log::info('siniestro '.$model->id.'. Estado '.$estado_siniestro_id);
			if ($count > 1) {
				Log::info('actualizando estado '.$model->estado_siniestros[$count-2]->id. ' dias: '.Carbon::now()->diffInDays($model->estado_siniestros[$count-2]->pivot->created_at));
				$model->estado_siniestros()->updateExistingPivot($model->estado_siniestros[$count-2]->id, [
					// 'dias_en_estado_siniestro' => 44,
					'dias_en_estado_siniestro' => Carbon::now()->diffInDays($model->estado_siniestros[$count-2]->pivot->created_at),
				]);
			}
			Log::info('-------------------------------------');
		} 
	}

	static function attachBienes($siniestro, $bienes) {
		foreach ($bienes as $bien) {
			if (!isset($bien['id'])) {	
				Self::createBien($siniestro, $bien);
			} else {
				Self::updateBien($siniestro, $bien);
			}
		}
	}

	static function createBien($siniestro, $bien) {
		// Log::info('createBien');
		// Log::info($bien);
        $request = Self::getBienRequest($siniestro, $bien);
		$ct = new BienController();
		$ct->store($request);
	}

	static function updateBien($siniestro, $bien) {
        // $request = Self::getBienRequest($siniestro, $bien);
        $request = Self::getBienRequest($siniestro, $bien, true);
		$ct = new BienController();
		$ct->update($request, $bien['id']);
	}

	static function getBienRequest($siniestro, $bien, $array_reverse = false) {
		$request = new \Illuminate\Http\Request();
		foreach ($bien as $key => $value) {
			if ($key == 'coberturas' && $array_reverse) {
				$value = array_reverse($value);
			} 
			$request->{$key} = $value;
		}
		$request->model_id = $siniestro->id;
		if (isset($bien['childrens'])) {
			$request->childrens = $bien['childrens'];
		}
		return $request;
	}

	static function checkEstadoSiniestroCerrado($siniestro) {
		if ($siniestro->estado_siniestro->significa_que_siniestro_fue_cerrado) {
			$siniestro->cerrado = 1;
			$siniestro->save();
		}
	}

	static function set_whatsapp_enviado_en_estado_siniestro_actual($siniestro_id) {
        $siniestro = Siniestro::find($siniestro_id);
        $siniestro->estado_siniestros()->updateExistingPivot($siniestro->estado_siniestro_id, [
        	'whatsapp_send' => 1
        ]);
	}

	static function set_email_enviado_en_estado_siniestro_actual($siniestro_id) {
        $siniestro = Siniestro::find($siniestro_id);
        $siniestro->estado_siniestros()->updateExistingPivot($siniestro->estado_siniestro_id, [
        	'email_send' => 1
        ]);
	}

}