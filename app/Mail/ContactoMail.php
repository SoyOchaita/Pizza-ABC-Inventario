<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactoMail extends Mailable 
{
    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->from('ochaita2404@gmail.com') 
                    ->replyTo($this->details['email'])
                    ->subject('Nuevo mensaje de contacto')
                    ->view('emails.contact');
    }
}
