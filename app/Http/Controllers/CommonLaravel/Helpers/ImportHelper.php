<?php

namespace App\Http\Controllers\CommonLaravel\Helpers;
use Illuminate\Support\Facades\Log;

class ImportHelper {

	static function getColumnValue($row, $key, $columns) {
		if (isset($columns[$key])) {
			return $row[$columns[$key]];
		}
		return null;
	}

}