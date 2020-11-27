<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmacaoUser extends Mailable
{
   public $nome;
   public $link;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $link)
    {
     $this->nome = $nome;
     $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('luis.weslley21@gmail.com', 'SVEIK')
                    ->subject('Confirmação de conta')
                    ->view('emails.Confirmacao');
    }
}
