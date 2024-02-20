<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\FotoEstudioMercado;
use Illuminate\Http\Request;

class HelperController extends Controller
{

    function callMethod($method) {
        $this->{$method}();
    }
    
    function set_fotos_estudio_mercado() {
        $bienes = Bien::all();
        foreach ($bienes as $bien) {
            if (!is_null($bien->foto_estudio_mercado)) {
                FotoEstudioMercado::create([
                    'image_url' => $bien->foto_estudio_mercado,
                    'bien_id'   => $bien->id,
                ]);
                echo 'Se creo imagen para '.$bien->nombre. ' </br>';
            }
        }
        echo 'Listo';
    }
}
