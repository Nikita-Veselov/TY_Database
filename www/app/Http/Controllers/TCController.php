<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTCRequest;
use App\Models\ControlledPoint;
use App\Models\TC;
use App\Models\TY;
use Illuminate\Http\Request;

class TCController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tc.create', [
            'TC' => TC::all()
        ]);

    }

    public function store(CreateTCRequest $request)
    {
        TC::create([
            "" => $request->number,
            "" => $request->type,
            "" => $request->date,
            "" => $request->controlledPoint,
            "" => $request->device,
            "" => $request->UTY,
            "" => $request->UTC,
            "" => $request->worker,
        ]);
        return route('controlledPoints');
    }

    public function edit(TC $tc)
    {
        return view('tc.edit', [
            'tc' => $tc,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTCRequest $request, TC $tc)
    {
        $tc = TC::find($tc->id);
        $tc->number = $request->number;
        $tc->type = $request->type;
        $tc->date = $request->date;
        $tc->controlledPoint = $request->controlledPoint;
        $tc->device = $request->device;
        $tc->UTY = $request->UTY;
        $tc->UTC = $request->UTC;
        $tc->worker = $request->worker;
        $tc->save();
        return route('controlledPoints');
    }
}
