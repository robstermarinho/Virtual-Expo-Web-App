<?php

namespace App\Mail;

use App\Bookin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailReport extends Mailable
{
    use Queueable, SerializesModels;

    public $bookins;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $bookins)
    {
        $this->bookins = $bookins; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.report')->subject('Virtual Expo Report');
    }
}
