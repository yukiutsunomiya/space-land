<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**cd 
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('k317708@gmail.com', 'UTSUNOMIYA')
        ->view('sendEmail')
        ->subject('テストメッセージ');
    }
}
