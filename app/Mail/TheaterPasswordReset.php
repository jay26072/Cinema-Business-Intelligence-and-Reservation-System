<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TheaterPasswordReset extends Mailable
{
   
    public $theater;
    public $password;


    public function __construct($theater, $password)
    {
        $this->theater = $theater;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Theater Password Has Been Reset')
                    ->view('Mail.theater_reset');
    }
}
