<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Bankdetail;
use App\Models\PaymentHistory;
use App\Models\Ticket;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if (auth()->user()->role == 'admin') {
            $vendors = Vendor::where('active',1)->whereNull('branch_id')->get();
        }elseif (auth()->user()->role == 'branch_manager') {
            $vendors = Vendor::where('branch_id',auth()->user()->branch_id)->get();
        }else{
           abort(404);
        }
        return view('vendors.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vendor = New Vendor;
        $vendor->name = $request->name;
        $vendor->active = 1;
        if (auth()->user()->role == 'branch_manager') {
            $vendor->branch_id = auth()->user()->branch_id;
        }
        $vendor->active = 1;
        $vendor->save();
        return redirect()->route('vendors.index')->withSuccess('Your changes have been successfully saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        $tickets =  Ticket::where('vendor_id',$vendor->id)->latest()->get();
        return view('vendors.view',compact('vendor','tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('vendors.edit',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $vendor->name = $request->name;
        $vendor->active = 1;
        $vendor->save();
        return redirect()->route('vendors.index')->withSuccess('Your changes have been successfully saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->active = 0;
        $vendor->save();
        return redirect()->route('vendors.index')->withSuccess('Your changes have been successfully delete!');
    }

    public function paynow(Request $request)
    {
        $vendor = Vendor::find($request->vendor_id);
        $vendor->total = $vendor->total+$request->amount;
        $vendor->due = $vendor->due-$request->amount;
        $vendor->save();

        $bank = Bank::find($request->bank);
        $bank->amount = $bank->amount-$request->amount;
        $bank->save();

        $history = New PaymentHistory;
        $history->amount = $request->amount;
        $history->vendor_id = $request->vendor_id;
        $history->bank_id = $request->bank;
        $history->save();

        $bankdetail = New Bankdetail;
        $bankdetail->bank_id = $bank->id;
        $bankdetail->amount = $request->amount;
        $bankdetail->status = 'Withdrawal';
        $bankdetail->note = $vendor->name .' vandor Dou pay';
        $bankdetail->save();
        return redirect()->back()->withSuccess('Your paymet successfully done!');


    }

    public function payemntHistory($id)
    {
        $items = PaymentHistory::where('vendor_id',$id)->latest()->get();
        return view('vendors.payment',compact('items'));
    }

    public function deletePaymentHustory($id)
    {
        PaymentHistory::find($id)->delete();
        return redirect()->back()->withSuccess('Your paymet successfully delete!');
    }

    public function print($id)
    {
        $vendor = Vendor::find($id);
        $tickets =  Ticket::where('vendor_id',$id)->latest()->get();
        return view('vendors.invoice',compact('vendor','tickets'));
    }


}
