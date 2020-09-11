<?php

namespace App\Listeners;

use App\Events\PaymentSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentSuccess  $event
     * @return void
     */
    public function handle(PaymentSuccess $event)
    {
        Mail::to($event->user)->send(new SendSuccessPayment($event->payment));
    }
}