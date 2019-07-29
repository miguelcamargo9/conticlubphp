<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Recover extends Mailable {

  use Queueable,
      SerializesModels;

  public $data;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($data) {
    $this->data = $data;
  }

  public function build() {
    return $this->view('mails.recover')->subject("Recuperar contraseña");
  }

}
