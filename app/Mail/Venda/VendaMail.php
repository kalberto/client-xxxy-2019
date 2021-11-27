<?php

namespace App\Mail\Venda;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VendaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject, $mensagem, $venda, $codigo_venda;

	/**
	 * Create a new message instance.
	 *
	 * @param string $nome_cliente
	 * @param string $link_venda
	 */
    public function __construct($subject,$message,$link_venda = null, $codigo_venda = null)
    {
        $this->subject = $subject;
        $this->mensagem = $message;
        $this->venda = $link_venda;
        $this->codigo_venda = $codigo_venda;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.venda');
    }
}
