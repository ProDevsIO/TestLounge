<?php

namespace App\Mail;

use App\Models\RegisterTest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class TestReceipt extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $test;
    public $subject;
    public $pdf;


    public function __construct($test_id,$subject)
    {
        $test = RegisterTest::where('id',$test_id)->first();
        $this->test = $test;
        $this->subject = $subject; 
        $this->from_ = env('MAIL_FROM_ADDRESS');
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $test = $this->test;
       
        view()->share('test',$test);
      
        $pdf = PDF::loadView('email.test_pdf', $test);

        return $this->from($this->from_, $this->subject)
            // ->attachData($pdf->output(),'test_receipt.pdf')
            ->view('email.message')
            ->with(compact('test'));

    }
}
