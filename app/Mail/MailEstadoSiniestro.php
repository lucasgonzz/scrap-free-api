<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MailEstadoSiniestro extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($gestor_scrap_free_email, $asunto, $mensaje)
    {
        $this->gestor_scrap_free_email = $gestor_scrap_free_email;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Log::info('Mensaje');
        // Log::info($this->mensaje);
        Log::info('gestor_scrap_free_email');
        Log::info($this->gestor_scrap_free_email);
        return $this->subject($this->asunto)
                    ->from($this->gestor_scrap_free_email, $this->gestor_scrap_free_email)
                    ->markdown('emails.siniestros.estado_siniestro', [
                        'mensaje'  => $this->mensaje,
                        'logo_url'  => 'https://api.scrapfree.com.ar/public/storage/logo.png',
                    ]);
    }
}
