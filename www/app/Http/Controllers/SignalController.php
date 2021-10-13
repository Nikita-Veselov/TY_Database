<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSignalRequest;
use App\Models\ControlledPoint;
use App\Models\TC;
use App\Models\TY;
use Illuminate\Http\Request;

class SignalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->CP == null) {
            return back()->withErrors('Выберите КП');
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */

        return view('signals.index', [
            'code' => $request->CP,
            'TC' => TC::where('cp-code', $request->CP)->get(),
            'TY' => TY::where('cp-code', $request->CP)->get(),
            'CP' => ControlledPoint::where('code', $request->CP)->first()
        ]);
    }

        /**
         * Show the form for creating a new resource.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
    public function create(ControlledPoint $cp)
    {
        dd($cp->code);
        return view('signals.create', [
            'tc' => TC::all(),
            'ty' => TY::all(),
            'cp' => ControlledPoint::where('code', $cp->code)
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CreateSignalRequest $request)
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
        return route('signals');
    }

    public function edit(ControlledPoint $cp)
    {
        return view('signals.edit', [
            'tc' => TC::all(),
            'ty' => TY::all(),
            'CP' => ControlledPoint::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TC  $record
     * @param  \App\Models\TY  $record
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSignalRequest $request, TC $tc, TY $ty)
    {
        $tc = TC::find($tc->id);
        $ty = TY::find($ty->id);

        $tc->number = $request->number;
        $tc->type = $request->type;
        $tc->date = $request->date;
        $tc->controlledPoint = $request->controlledPoint;
        $tc->device = $request->device;
        $tc->UTY = $request->UTY;
        $tc->UTC = $request->UTC;
        $tc->worker = $request->worker;
        $tc->save();

        return route('signals');
    }
}
