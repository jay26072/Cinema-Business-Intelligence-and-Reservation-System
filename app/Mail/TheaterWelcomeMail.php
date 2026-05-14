<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TheaterWelcomeMail extends Mailable
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
         return $this->subject('🎬 Welcome to Cinema Booking Platform')
                    ->view('Mail.theater_welcome');
    }
}
