<?php

namespace App\Http\Controllers\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SiniestroHelper {
	
	static function attachEstadoSiniestro($model, $estado_siniestro_id, $from_store = false) {
		if ($from_store || $model->estado_siniestro_id != $estado_siniestro_id) {
			Log::info('Se agrego el estado_siniestro_id');
			$model->estado_siniestros()->attach($estado_siniestro_id, [
				'created_at'	=> Carbon::now(),
			]);
		} else {
			Log::info('No se aagrego, actualmente tiene el '.$model->estado_siniestro_id.' y llego el '.$estado_siniestro_id);
		}
	}

}