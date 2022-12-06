<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Console\Command;

class DueDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duedate:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sms Send due flight date';

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
       $tickets = Ticket::where('due','>',0)->where('flight_date', '<',Carbon::now()->addDays(3)->toDateTimeString())->where('flight_date', '>',Carbon::now())->get();
       foreach ($tickets as $key => $ticket) {
            $message = "Your Filed Date ". date('g:i a : F j, Y', strtotime($ticket->flight_date));
            $number = $ticket->number;
            brilliantSMS($message,$number);
       }
    }
}
