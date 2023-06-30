<?php

namespace App\Http\Controllers;

use App\Models\Siniestro;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    function pdf($siniestro_id, $name) {
        $name = 'App\Http\Controllers\Pdf\-'.$name.'Pdf';
        $name = str_replace('-', '', $name);
        $siniestro = Siniestro::find($siniestro_id);
        new $name($siniestro);
    }
}
