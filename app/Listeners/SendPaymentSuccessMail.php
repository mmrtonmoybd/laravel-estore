<?php

namespace App\Listeners;

use App\Events\PaymentSuccess;
use App\Mail\SendSuccessPayment;
use Mail;

class SendPaymentSuccessMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentSuccess $event)
    {
        Mail::to($event->user)->send(new SendSuccessPayment($event->payment));
    }
}
