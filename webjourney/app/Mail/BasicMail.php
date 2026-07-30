<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BasicMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title='';
    public $info='';
    public $messages='';

    public function __construct($title='', $info='', $messages='')
    {
        $this->title = $title;
        $this->info = $info;
        $this->messages = $messages;
    }

    public function build()
    {
        $title = $this->title;
        $info = $this->info;
        $messages = $this->messages;
        return $this->view('emails.basic_mail',compact('title','info','messages'))->subject($title);
    }

}
