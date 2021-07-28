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
    public $from_;
    public $code;

    public function __construct($booking_product_id = null,$subject = "Booking",$from = null,$code)
    {
        $booking_product = BookingProduct::where('id',$booking_product_id)->first();

        $this->booking_product = $booking_product;
        $this->booking = $booking_product->booking;
        $this->product = $booking_product->product;
        $this->vendor = $booking_product->vendor;

        $this->subject = $subject;
        $this->from_ = $from;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
//http://uktraveltest.test/payment/confirmation?status=successful&tx_ref=booking_60f0c955a1a03277427&transaction_id=2349299
    public function build()
    {
        $booking = $this->booking;
        $product = $this->product;
        $vendor = $this->vendor;
        $booking_product = $this->booking_product;
        $code = $this->code;

        $data = [
            'booking' => $booking,
            'booking_product' => $booking_product,
            'product' => $product,
            'vendor' => $vendor
        ];

        $pdf = PDF::loadView('email.receipt', $data, [
            'format' => 'A4'
        ]);

        $this->from_ = $vendor->email;

        return $this->from($this->from_,$this->subject)
            ->attachData($pdf->output(),'receipt.pdf')
            ->view('email.receipt')
            ->with(compact('booking','booking_product','product','vendor','code'));

    }
}
