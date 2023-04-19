<?php

namespace App\Http\Controllers\CommonLaravel\Helpers;

class StringHelper {

	static function modelName($name, $ucwords = false) {
		if ($ucwords) {
			return ucwords(strtolower($name));
		}
		return ucfirst(strtolower($name));
	}

	static function onlyFirstWordUpperCase($string) {
		return ucfirst(strtolower($string));
	}

    static function short($string, $length) {
        if (strlen($string) > $length) {
            $string = substr($string, 0, $length-2) . '..';
        }
        return $string;
    }
	
}