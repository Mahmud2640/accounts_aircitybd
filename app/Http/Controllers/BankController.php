<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Bankdetail;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Bank::latest()->get();
        return view('banks.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = New Bank;
        $item->name = $request->name;
        $item->amount = $request->amount ? $request->amount : 0;
        $item->save();
        return redirect()->route('banks.index')->withSuccess('Your changes have been successfully saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Bank $bank)
    {
        $conditions = ['bank_id' => $bank->id];

        if ($request->status) {
            $conditions = array_merge($conditions, ['status' => $request->status]);
        }
        $bankdetails = Bankdetail::where($conditions);

        if($request->s){
            $bankdetails = $bankdetails->whereBetween('created_at', [$request->start_date .' 00:00:00', $request->end_date .' 23:59:59'])->where('created_at','>=',$request->start_date.'-00:00:00')->latest()->get();
        }
        else{
            $bankdetails = $bankdetails->whereBetween('created_at', [date('Y-m-d') .' 00:00:00', date('Y-m-d') .' 23:59:59'])->latest()->get();
        }
        return view('banks.view',compact('bank','bankdetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        return view('banks.edit',compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $bank->name = $request->name;
        $bank->save();
        return redirect()->route('banks.index')->withSuccess('Your changes have been successfully update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Bank::find($id);
        $item->delete();
        return redirect()->route('banks.index')->withSuccess('Your changes have been successfully delete!');
    }

    public function blanchUpdate(Request $request)
    {
        $item = Bank::find($request->id);
        if ($request->update == 'deposit') {
            $item->amount = $item->amount+$request->amount;

            $bankdetail = New Bankdetail;
            $bankdetail->bank_id = $item->id;
            $bankdetail->amount = $request->amount;
            $bankdetail->status = 'deposit';
            $bankdetail->note = $request->note;
            $bankdetail->save();

        }else{
            $item->amount = $item->amount-$request->amount;

            $bankdetail = New Bankdetail;
            $bankdetail->bank_id = $item->id;
            $bankdetail->amount = $request->amount;
            $bankdetail->status = 'Withdrawal';
            $bankdetail->note = $request->note;
            $bankdetail->save();

        }
        $item->save();
        return redirect()->route('banks.index')->withSuccess('Your balanc have been successfully update!');

    }

    public function bank_transfor(Request $request)
    {
        $form = Bank::findOrFail($request->id);
        $tos = Bank::where('id', '!=' , $request->id)->get();
        return view('banks.transfor',compact('form','tos'));
    }

    public function bank_transfor_update(Request $request)
    {
        $form = Bank::findOrFail($request->form);
        $to = Bank::findOrFail($request->to);

        $form->amount = $form->amount-$request->amount;
        $form->save();

        if($form->save()){
            $bankdetail = New Bankdetail;
            $bankdetail->bank_id = $form->id;
            $bankdetail->amount = $request->amount;
            $bankdetail->status = 'Withdrawal';
            $bankdetail->note = 'Bank transfor to '. $to->name;
            $bankdetail->save();
        }

        $to->amount = $to->amount+$request->amount;
        $to->save();

        if($to->save()){
            $bankdetail = New Bankdetail;
            $bankdetail->bank_id = $to->id;
            $bankdetail->amount = $request->amount;
            $bankdetail->status = 'deposit';
            $bankdetail->note = 'Bank transfor received '. $form->name;
            $bankdetail->save();
        }
        return redirect()->route('banks.index')->withSuccess('Your balanc have been successfully transfor!');

    }

}
