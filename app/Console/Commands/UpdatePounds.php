<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Http;

class UpdatePounds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:pounds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update the prices of naira equivalent in pounds';

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
        \Log::info("Cron is working fine!");
     
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
        $response = Http::get('http://data.fixer.io/api/latest?access_key=8b0fdd2b8b030aabf1d8345e86d352d7&symbols=NGN');
        $response->body();
        
        $this->info('update pounds Cummand Run successfully!');
    }
}
