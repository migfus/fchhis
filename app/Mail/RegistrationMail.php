<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $isSuccess, $logo, $email, $name;

    public function __construct($email, $name) {
        $this->logo = asset('https://fchhis.migfus.net/images/logo.png');
        $this->email = $email;
        $this->name = $name;
    }

    public function build() {
        return $this->from($this->email, 'FCHHIS Registration')
        ->subject('Your Registration is Successful!!!')
        ->view('emails.registration',['name'=>$this->name, 'logo' => $this->logo]);
    }
}
