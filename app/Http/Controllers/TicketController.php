<?php

namespace App\Http\Controllers;

use App\Models\SaleVendor;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Bank;
use App\Models\Bankdetail;
use Illuminate\Http\Request;
use PDF;
use phpDocumentor\Reflection\Types\Null_;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::latest()->get();
        // if (auth()->user()->role == 'admin') {
        //     $tickets = Ticket::latest()->get();
        // }elseif (auth()->user()->role == 'branch_manager') {
        //     $ids = User::where('branch_id',auth()->user()->branch_id)->pluck('id');
        //     $tickets = Ticket::whereIn('user_id',$ids)->latest()->get();
        // }else{
        //     $tickets = Ticket::where('user_id',auth()->user()->id)->latest()->get();
        // }

        return view('tickets.index',compact('tickets'));
    }

    public function ticket_type($type)
    {
        $tickets = Ticket::where('type',$type)->latest()->get();
        // if (auth()->user()->role == 'admin') {
        //     $tickets = Ticket::where('type',$type)->latest()->get();
        // }elseif (auth()->user()->role == 'branch_manager') {
        //     $ids = User::where('branch_id',auth()->user()->branch_id)->pluck('id');
        //     $tickets = Ticket::where('type',$type)->whereIn('user_id',$ids)->latest()->get();
        // }else{
        //     $tickets = Ticket::where('type',$type)->where('user_id',auth()->user()->id)->latest()->get();
        // }

        return view('tickets.index',compact('tickets'));
    }

    public function ticket_due()
    {
        $tickets = Ticket::where('sale_vendor_id',Null)->where('due', '>', 0)->latest()->get();
        return view('tickets.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'flight_date' => 'required',
        // ]);
        $ticket = New Ticket;
        $ticket->user_id = auth()->user()->id;
        $ticket->name = $request->name;
        $ticket->number = $request->number;
        $ticket->code = $request->code;
        $ticket->passport_number = $request->passport_number;
        $ticket->airline_id = $request->airline_id;
        $ticket->refered_by = $request->refered_by;
        $ticket->payment_states = $request->payment_states;
        $ticket->sector_id = $request->sector_id;
        $ticket->pay = $request->pay ? $request->pay : 0;
        $ticket->due = $request->due ? $request->due : 0;
        $ticket->discount = $request->discount ? $request->discount : 0;
        $ticket->amount = $request->amount ? $request->amount : 0;
        $ticket->purchase = $request->purchase ? $request->purchase : 0;
        $ticket->flight_date = $request->flight_date;
        $ticket->type = $request->type;
        $ticket->purchase_by = $request->purchase_by;
        $ticket->vendor_id = $request->vendor_id;
        $ticket->states = $request->states;
        $ticket->note = $request->note;
        if ($request->passport_copy) {
            $ticket->passport_copy = $request->file('passport_copy')->store('uploads/ticket');
        }
        if ($request->ticket_copy) {
            $ticket->ticket_copy = $request->file('ticket_copy')->store('uploads/ticket');
        }
        if ($request->visa_copy) {
            $ticket->visa_copy = $request->file('visa_copy')->store('uploads/ticket');
        }
        if ($request->id_copy) {
            $ticket->id_copy = $request->file('id_copy')->store('uploads/ticket');
        }
        if ($request->others_copy) {
            $ticket->others_copy = $request->file('others_copy')->store('uploads/ticket');
        }
        if ($request->sale_vendor_id) {
            $ticket->sale_vendor_id = $request->sale_vendor_id;
            $saleVendor = SaleVendor::find($request->sale_vendor_id);
            if ($saleVendor) {
                $saleVendor->amount = $saleVendor->amount+$ticket->due;
                $saleVendor->save();
            }
        }


        $ticket->save();

        if ($request->vendor_id) {
            $vendor = Vendor::find($ticket->vendor_id);
            $vendor->due = $vendor->due + $ticket->purchase;
            $vendor->save();
        }

        if ($ticket->sector) {
            $sector = $ticket->sector->name;
        }else{
            $sector = Null;
        }

        $message = 'Dear sir Greeting form Aircitybd Travels '. $ticket->name .' ' . $ticket->type .' '. $sector . ' Total price .'. $ticket->amount .'. Your Order has been confirmed www.aircitybd.com' ;
        $number = $ticket->number;

        if ($request->smssend == 1) {
            if ($number) {
                brilliantSMS($message,$number);
            }
        }

        if($request->bank && $request->pay){
            $bank = Bank::find($request->bank);
            $bank->amount = $bank->amount+$request->pay;

            $bankdetail = New Bankdetail;
            $bankdetail->bank_id = $bank->id;
            $bankdetail->amount = $request->pay;
            $bankdetail->status = 'deposit';
            $bankdetail->note = $request->note;
            $bankdetail->save();

            $bank->save();
        }

        if ($request->sale_vendor_id) {
            return redirect()->route('salevendor.show',$request->sale_vendor_id)->withSuccess('Your changes have been successfully saved!');
        }else{
            return redirect()->route('tickets.ticket_type',$ticket->type)->withSuccess('Your changes have been successfully saved!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {

        // $pdf = PDF::setOptions([
        //         'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
        //         'logOutputFile' => storage_path('logs/log.htm'),
        //         'tempDir' => storage_path('logs/')
        //     ])->loadView('tickets.pdfinvoice',compact('ticket'));
        // return $pdf->download('ticket-'.$ticket->code.'.pdf');

        return view('tickets.pdfinvoice',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit',compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        if ($ticket->purchase != (int)$request->purchase) {
            $vendor = Vendor::find($request->vendor_id);
            if ($vendor) {
                $vendor->due = $vendor->due + $request->purchase;
                $vendor->save();
            }
        }
        $ticket->name = $request->name;
        $ticket->number = $request->number;
        $ticket->code = $request->code;
        $ticket->passport_number = $request->passport_number;
        $ticket->airline_id = $request->airline_id;
        $ticket->refered_by = $request->refered_by;
        $ticket->payment_states = $request->payment_states;
        $ticket->sector_id = $request->sector_id;
        $ticket->pay = $request->pay ? $request->pay : 0;
        $ticket->due = $request->due ? $request->due : 0;
        $ticket->discount = $request->discount ? $request->discount : 0;
        $ticket->amount = $request->amount ? $request->amount : 0;
        $ticket->purchase = $request->purchase ? $request->purchase : 0;
        $ticket->flight_date = $request->flight_date;
        $ticket->purchase_by = $request->purchase_by;
        $ticket->type = $request->type;
        $ticket->vendor_id = $request->vendor_id;
        $ticket->states = $request->states;
        $ticket->note = $request->note;
        if ($request->passport_copy) {
            $ticket->passport_copy = $request->file('passport_copy')->store('uploads/ticket');
        }
        if ($request->ticket_copy) {
            $ticket->ticket_copy = $request->file('ticket_copy')->store('uploads/ticket');
        }
        if ($request->visa_copy) {
            $ticket->visa_copy = $request->file('visa_copy')->store('uploads/ticket');
        }
        if ($request->id_copy) {
            $ticket->id_copy = $request->file('id_copy')->store('uploads/ticket');
        }
        if ($request->others_copy) {
            $ticket->others_copy = $request->file('others_copy')->store('uploads/ticket');
        }
        $ticket->save();


        return redirect()->route('tickets.ticket_type',$ticket->type)->withSuccess('Your changes have been successfully saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->sale_vendor_id) {
            $saleVendor = SaleVendor::find($ticket->sale_vendor_id);
            if ($saleVendor) {
                $saleVendor->amount = $saleVendor->amount-$ticket->due;
                $saleVendor->save();
            }
        }
        $ticket->delete();
        return redirect()->route('tickets.index')->withSuccess('Your changes have been successfully delete!');
    }

    public function details(Request $request)
    {
        $ticket = Ticket::findOrFail($request->id);
        return view('tickets.view',compact('ticket'));
    }

    public function due_paid(Request $request)
    {
        $ticket = Ticket::findOrFail($request->id);
        $ticket->pay = $ticket->pay+$request->amount;
        $ticket->due = $ticket->due-$request->amount;
        $ticket->save();
        if($request->bank){
            $item = Bank::find($request->bank);
            $item->amount = $item->amount+$request->amount;

            $bankdetail = New Bankdetail;
            $bankdetail->bank_id = $item->id;
            $bankdetail->amount = $request->amount;
            $bankdetail->status = 'deposit';
            $bankdetail->note = 'Name: '.$ticket->name. ', Code: '.$ticket->code. ', Reg Type: '. $ticket->type .', Note: '. $request->note;
            $bankdetail->save();

            $item->save();
        }
        return redirect()->back()->withSuccess('Due have been successfully update!');
    }

    public function due_paid_model(Request $request)
    {
        $ticket = Ticket::findOrFail($request->id);
        return view('tickets.paidModel',compact('ticket'));
    }

}
