<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;
use App\Models\Tracking;

class Pengiriman extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $order;

    public $track;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $track = Tracking::where('order_id',$this->order->order_id)->first();
        $this->track = $track;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pesanan Anda Telah Dikirim')->view('email.pengiriman');
    }
}
