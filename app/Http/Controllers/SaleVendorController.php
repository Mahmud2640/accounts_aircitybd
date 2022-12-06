<?php

namespace App\Http\Controllers;

use App\Models\SaleVendor;
use App\Models\Ticket;
use App\Models\saleVendorPayment;
use Illuminate\Http\Request;

class SaleVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = SaleVendor::latest()->get();
        return view('salevendor.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salevendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = New SaleVendor;
        $item->name = $request->name;
        $item->mobile = $request->mobile;
        $item->amount = $request->amount ? $request->amount : 0;
        $item->save();
        return redirect()->route('salevendor.index')->withSuccess('Your changes have been successfully saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleVendor  $saleVendor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saleVendor = SaleVendor::find($id);
        $tickets =  Ticket::where('sale_vendor_id',$id)->latest()->get();
        return view('salevendor.view',compact('saleVendor','tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleVendor  $saleVendor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saleVendor = SaleVendor::find($id);
        return view('salevendor.edit',compact('saleVendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleVendor  $saleVendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $saleVendor = SaleVendor::find($id);
        $saleVendor->name = $request->name;
        $saleVendor->mobile = $request->mobile;
        $saleVendor->save();
        return redirect()->route('salevendor.index')->withSuccess('Your changes have been successfully update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleVendor  $saleVendor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = SaleVendor::find($id);
        $item->delete();
        return redirect()->route('salevendor.index')->withSuccess('Your changes have been successfully delete!');
    }

    public function blanchUpdate(Request $request)
    {
        $item = SaleVendor::find($request->id);
        if ($request->update == 'deposit') {
            $item->amount = $item->amount+$request->amount;
        }else{
            $item->amount = $item->amount-$request->amount;
            $item->total = $item->total+$request->amount;

            $payment = New saleVendorPayment;
            $payment->sale_vendor_id = $request->id;
            $payment->amount = $request->amount;
            $payment->status = 'due paid';
            $payment->note = $request->note;
            $payment->save();

        }
        $item->save();
        return redirect()->route('salevendor.index')->withSuccess('Your balanc have been successfully update!');

    }

    public function register($id)
    {
        return view('salevendor.register',compact('id'));
    }

    public function paymetnhistory($id)
    {
        $dates = saleVendorPayment::where('sale_vendor_id',$id)->latest()->get();
        return view('salevendor.payment',compact('dates'));
    }

    public function print($id)
    {
        $saleVendor = SaleVendor::find($id);
        $tickets =  Ticket::where('sale_vendor_id',$id)->latest()->get();
        return view('salevendor.print',compact('saleVendor','tickets'));
    }

}
