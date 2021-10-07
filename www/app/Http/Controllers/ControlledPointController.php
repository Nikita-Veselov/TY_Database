<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateControlledPointRequest;
use App\Models\ControlledPoint;
use Illuminate\Http\Request;

class ControlledPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('controlledPoints.index', ['controlledPoints' => ControlledPoint::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('controlledPoints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateControlledPointRequest $request)
    {
        ControlledPoint::create([
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
        ]);
        return $this->index()->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devices  $record
     * @return \Illuminate\Http\Response
     */
    public function show(ControlledPoint $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devices  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(ControlledPoint $record)
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
    public function update(Request $request, ControlledPoint $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devices  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControlledPoint $record)
    {
        //
    }
}
