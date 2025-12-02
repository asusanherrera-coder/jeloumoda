<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistroUsuarioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // variable pública para la vista

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Bienvenido a Jelou Moda')
                    ->view('emails.registro_usuario'); // vista que crearemos
    }
}