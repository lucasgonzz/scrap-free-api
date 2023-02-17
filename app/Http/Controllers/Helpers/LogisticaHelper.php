<?php

namespace App\Http\Controllers\Helpers;

use App\Models\Bien;
use Carbon\Carbon;

class LogisticaHelper {
	
	static function setBienes($model, $bienes) {
		foreach ($model->bienes as $bien) {
			$bien->logistica_id = null;
			$bien->save();
		}
		foreach ($bienes as $bien) {
			Bien::find($bien['id'])
			->update([
				'logistica_id'	=> $model->id,
			]);
		}
	}

}