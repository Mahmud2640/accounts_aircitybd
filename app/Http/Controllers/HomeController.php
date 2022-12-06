<?php

namespace App\Http\Controllers;

use App\Mail\CliendMail;
use Mail;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $sales = Ticket::selectRaw('year(created_at) as year, monthname(created_at) as month, sum(amount) as amount')
                ->groupBy('year','month')
                ->orderByRaw('min(created_at) desc')
                ->get();
            $tickets = Ticket::where('due','>',0)->where('flight_date', '<',Carbon::now()->addDays(3)->toDateTimeString())->where('flight_date', '>',Carbon::now())->get();
        }else{
            $sales = Ticket::where('user_id',auth()->user()->id)->selectRaw('year(created_at) as year, monthname(created_at) as month, sum(amount) as amount')
                ->groupBy('year','month')
                ->orderByRaw('min(created_at) desc')
                ->get();
            $tickets = Ticket::where('user_id',auth()->user()->id)->where('due','<',0)->where('flight_date', '<',Carbon::now()->addDays(3)->toDateTimeString())->where('flight_date', '>',Carbon::now())->get();
        }
        //dd($sales);
        return view('index',compact('sales','tickets'));
    }

    public function send_mail(Request $request)
    {
        $ticket = Ticket::find($request->id);
        $array['subject'] = $request->subject;
        $array['from'] = env('MAIL_USERNAME');
        $array['content'] = $request->subject;
        $array['passport_copy'] = asset($ticket->passport_copy);
        $array['ticket_copy'] = asset($ticket->ticket_copy);
        $array['visa_copy'] = asset($ticket->visa_copy);
        $array['others_copy'] = asset($ticket->others_copy);

        if(env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null){
            Mail::to($request->email)->queue(new CliendMail($array));
        }
       return redirect()->back()->withSuccess('Your mail have been successfully send!');
    }

    public function send_sms(Request $request)
    {

        $message = $request->message;
        foreach(explode(",", $request->number) as $number){
            brilliantSMS($message,$number);
        }
        return redirect()->back()->withSuccess('Your message have been successfully send!');
    }

}
