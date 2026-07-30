<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $name='';
    public $email='';
    public $messages='';

    public function __construct($name,$email,$messages)
    {
        $this->name = $name;
        $this->email = $email;
        $this->messages = $messages;
    }

    public function build()
    {
        $name = $this->name;
        $email = $this->email;
        $messages = $this->messages;
        return $this->view('emails.contact_message',compact('name','email','messages'));
    }
}
