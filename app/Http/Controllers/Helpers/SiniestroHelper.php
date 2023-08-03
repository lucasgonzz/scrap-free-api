<?php

namespace App\Http\Controllers\Helpers;

use App\Models\Siniestro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SiniestroHelper {
	
	static function attachEstadoSiniestro($model, $estado_siniestro_id, $from_store = false, $created_at = null) {
		if (is_null($created_at)) {
			$created_at = Carbon::now();
		}
		if ($from_store || $model->estado_siniestro_id != $estado_siniestro_id) {
			$model->estado_siniestros()->attach($estado_siniestro_id, [
				'created_at'	=> $created_at,
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

	static function checkEstadoSiniestroCerrado($siniestro) {
		if ($siniestro->estado_siniestro->significa_que_siniestro_fue_cerrado) {
			$siniestro->cerrado = 1;
			$siniestro->save();
		}
	}

}