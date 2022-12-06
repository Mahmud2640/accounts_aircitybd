<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::where('active',1)->get();
        return view('links.index',compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $link = New Link;
        $link->name = $request->name;
        $link->link = $request->link;
        $link->active = 1;
        if ($request->image) {
            $link->image = $request->file('image')->store('uploads/link');
        }
        $link->save();
        return redirect()->route('links.index')->withSuccess('Your changes have been successfully saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        return view('links.edit',compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        $link->name = $request->name;
        $link->link = $request->link;
        if ($request->image) {
            $link->image = $request->file('image')->store('uploads/link');
        }
        $link->save();
        return redirect()->route('links.index')->withSuccess('Your changes have been successfully saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Link::find($id);
        $vendor->delete();
        return redirect()->route('links.index')->withSuccess('Your changes have been successfully delete!');
    }
}
