<?php

namespace App\Http\Controllers;

use App\Mail\MailEstadoSiniestro;
use App\Models\EmailCredential;
use App\Models\Siniestro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    function sendEmail(Request $request, $estado_siniestro, $siniestro_id) {
        $this->siniestro = Siniestro::find($siniestro_id);
        $this->{$estado_siniestro}($request);
    }

    function contactar_asegurado($request) {
        $credencial = EmailCredential::where('gestor_scrap_free_id', $this->siniestro->gestor_scrap_free_id)
                                        ->first();

        $config = array(
            'driver'     => 'smtp',
            'host'       => 'smtp.gmail.com',
            'port'       => 465,
            'encryption' => 'ssl',
            'from'       => array('address' => $credencial->email, 'name' => $this->siniestro->gestor_scrap_free->nombre_formal),
            'username'   => $credencial->email,
            // 'password'   => 'ypbk qayo phdb dfbo',
            'password'   => $credencial->password,
            'sendmail'   => '/usr/sbin/sendmail -bs',
            'pretend'    => false,
        );
        Config::set('mail', $config);

        Mail::to($this->siniestro->email)->send(new MailEstadoSiniestro($credencial->email, $this->siniestro->numero_siniestro, $request->mensaje));
    }
}
