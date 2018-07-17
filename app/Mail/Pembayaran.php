<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;
use App\Models\Konfirmasi;

class Pembayaran extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $order;

    public $konfir;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $konfir = Konfirmasi::where('order_id',$this->order->order_id)->first();
        $this->konfir = $konfir;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pembayaran Telah Diterima')->view('email.pembayaran');
    }
}
