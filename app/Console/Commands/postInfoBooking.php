<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Users;
use App\Mail\BookingCreation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class postInfoBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:postInfoBooking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now()->subDay()->startOfDay();
        $now_end = Carbon::now()->subDay()->endOfDay();
        $bookings = Booking::where('post_status', 0)->wherebetween('arrival_date',[$now,$now_end])->get();

      
        $i= 0; 
         foreach($bookings as $booking)
         {
             $i++;
             $message = "Hi ".$booking->first_name. " ".$booking->last_name.",<br><br>

             While you are waiting for your COVID-19 Test kit, we want to highlight some important points about your test sample. <br><br>
             
             When conducting your test, please follow all instructions provided in the test pack. A copy of the instructions can be found <a href='https://ukhealthtesting.com/wp-content/uploads/2021/07/UK-Health-Testing-Instructions-07-21-1.pdf'>here</a><br><br>
             
             Once you have taken a sample please make sure you register your test <a href=' https://portal.ukhealthtesting.com'>here</a><br><br>
             
             Failure to register your test on the portal will mean your Test will not be processed by the laboratory due to UK Government guidelines and no test result or refund will be given.<br><br>
             
             UK Travel Tests Team.
             ";

            Mail::to($booking->email)->send(new BookingCreation($message, "Post Booking information"));
         }
         
         $bookings->update(['post_status' => 1]);

        echo $i;
    }
}
