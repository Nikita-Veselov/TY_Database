<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('devices');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devices  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Devices $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devices  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Devices $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Devices  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devices $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devices  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devices $record)
    {
        //
    }
}
