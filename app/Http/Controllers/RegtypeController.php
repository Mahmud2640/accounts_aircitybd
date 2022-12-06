<?php

namespace App\Http\Controllers;

use App\Models\Regtype;
use Illuminate\Http\Request;

class RegtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = Regtype::where('active',1)->get();
        return view('regtype.index',compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('regtype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sector = New Regtype;
        $sector->name = $request->name;
        $sector->active = 1;
        $sector->save();
        return redirect()->route('regtype.index')->withSuccess('Your changes have been successfully saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Regtype  $regtype
     * @return \Illuminate\Http\Response
     */
    public function show(Regtype $regtype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Regtype  $regtype
     * @return \Illuminate\Http\Response
     */
    public function edit(Regtype $regtype)
    {
        return view('regtype.edit',compact('regtype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Regtype  $regtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regtype $regtype)
    {
        $regtype->name = $request->name;
        $regtype->save();
        return redirect()->route('regtype.index')->withSuccess('Your changes have been successfully saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Regtype  $regtype
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sector = Regtype::find($id);
        $sector->active = 0;
        $sector->save();
        return redirect()->route('regtype.index')->withSuccess('Your changes have been successfully delete!');
    }
}
