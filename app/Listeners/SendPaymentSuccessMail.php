<?php

namespace App\Listeners;

use App\Events\PaymentSuccess;
use App\Mail\SendSuccessPayment;
use Mail;

class SendPaymentSuccessMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(PaymentSuccess $event)
    {
        Mail::to($event->user)->send(new SendSuccessPayment($event->payment));
    }
}
