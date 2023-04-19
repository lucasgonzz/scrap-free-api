<?php

namespace App\Http\Controllers\CommonLaravel\Helpers;
use Illuminate\Support\Facades\Log;

class Numbers {


	static function percentage($p) {
		return (float)$p / 100;
	}

    static function redondear($num) {
        return round($num, 2, PHP_ROUND_HALF_UP);
    }

	static function price($price) {
		$pos = strpos($price, '.');
		if ($pos != false) {
			$centavos = explode('.', $price)[1];
			$new_price = explode('.', $price)[0];
			if ($centavos != '00') {
				$new_price += ".$centavos";
				$resutl = number_format($price, 2, ',', '.');
			} else {
				$resutl = number_format($new_price, 0, '', '.');			
			}
		} else {
			$resutl = number_format($price, 0, '', '.');
		}
		return $resutl;
	}
}