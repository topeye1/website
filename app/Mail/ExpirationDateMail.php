<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpirationDateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $date_due;

    public function __construct($date_due)
    {
        $this->date_due = $date_due;
    }

    public function build()
    {
        return $this->view('emails.expiration_date')
            ->with(['date_due' => $this->date_due])
            ->subject('Expiration date of coupon');
    }
}
