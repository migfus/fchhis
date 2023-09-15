<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecoveryMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $isSuccess, $logo, $email, $name, $link;

    public function __construct($email, $name, $code) {
        $this->logo = asset('https://fchhis.migfus.net/images/logo.png');
        $this->email = $email;
        $this->name = $name;
        $this->link = 'http://127.0.0.1:8000/forgot/fill?code='.$code;
    }

    public function build() {
        return $this->from(env('MAIL_FROM_ADDRESS', 'admin@fchhis.migfus.net'), 'FCHHIS Account Recovery')
            ->subject('Account Recovery')
            ->view('emails.recovery',['name' => $this->name, 'logo' => $this->logo, 'link' => $this->link]);
    }
}
