<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CadastroUserAdmin extends Mailable
{
   public $email;
   public $nome;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $nome)
    {
     $this->email = $email;
     $this->nome = $nome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('luis.welley21@gmail.com', 'SVEIK')
                    ->subject('Novo usuario cadastrado')
                    ->view('emails.CadastroUserAdmin');
    }
}
