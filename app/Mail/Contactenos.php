<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contactenos extends Mailable
{
    use Queueable,
      SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build(): Contactenos
    {
        return $this->view('mails.contactenos')->subject($this->data['asunto']);
    }
}
