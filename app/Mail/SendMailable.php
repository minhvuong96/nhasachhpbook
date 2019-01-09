<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name,$remember_token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$remember_token)
    {
        //
         $this->name = $name;
          $this->remember_token = $remember_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('hpbook.emails.name');
    }
}
