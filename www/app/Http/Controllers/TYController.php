<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTYRequest;
use App\Models\TC;
use App\Models\TY;
use Illuminate\Http\Request;

class TYController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TY.create', [
            'TY' => TY::all()
        ]);
    }
    public function store(CreateTYRequest $request)
    {
        TY::create([
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

    public function edit(TY $ty)
    {
        return view('ty.edit', [
            'ty' => $ty,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTYRequest $request, TY $ty)
    {
        $ty = TC::find($ty->id);
        $ty->number = $request->number;
        $ty->type = $request->type;
        $ty->date = $request->date;
        $ty->controlledPoint = $request->controlledPoint;
        $ty->device = $request->device;
        $ty->UTY = $request->UTY;
        $ty->UTC = $request->UTC;
        $ty->worker = $request->worker;
        $ty->save();
        return route('controlledPoints');
    }
}
