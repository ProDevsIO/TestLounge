<?php

namespace App\Mail;

use App\Models\BookingProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;
class VendorReceipt extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $booking_product;
    public $booking;
    public $product;
    public $vendor;
    public $subject;
    public $from;

    public function __construct($booking_product_id = null,$subject = "Booking",$from = null)
    {
        $booking_product = BookingProduct::where('id',$booking_product_id)->first();

        $this->booking_product = $booking_product_id;
        $this->booking = $booking_product->booking->id;
        $this->product = $booking_product->product->id;
        $this->vendor = $booking_product->vendor->id;

        $this->subject = $subject;
        $this->from = $from;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $booking = $this->booking;
        $product = $this->product;
        $vendor = $this->vendor;
        $booking_product = $this->booking_product;

        $pdf = PDF::loadView('email.receipt', compact('booking','booking_product','product','vendor'), [
            'format' => 'A4'
        ]);


        return $this->from(($this->from) ? $this->from : 'info@prodevs.io',$this->subject)
            ->attachData($pdf->output(),'receipt.pdf')
            ->view('email.receipt')
            ->with(compact('booking','booking_product','product','vendor'));

    }
}
