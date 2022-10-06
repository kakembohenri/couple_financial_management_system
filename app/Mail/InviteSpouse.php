<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteSpouse extends Mailable
{
    use Queueable, SerializesModels;

    public $sender_email;
    public $reciever_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender_email, $reciever_email)
    {
        $this->sender_email = $sender_email;
        $this->reciever_email = $reciever_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invite')->subject('Invitation to join system');
    }
}
