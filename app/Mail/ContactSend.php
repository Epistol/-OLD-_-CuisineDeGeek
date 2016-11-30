<?php

namespace CDG\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('admin@cuisinedegeek.com')->view('modules.contact');

        /* return $this->from('admin@cuisinedegeek.com')->view('modules.contact')->with([
        'orderName' => $this->order->name,
        'orderPrice' => $this->order->price,
    ]); */


    }
}
