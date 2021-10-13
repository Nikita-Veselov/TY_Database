<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSignalRequest;
use App\Models\ControlledPoint;
use App\Models\TC;
use App\Models\TY;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SignalController extends Controller
{
    public function index(Request $request)
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */

        if ($request->CP == null) {
            return back()->withErrors('Выберите КП');
        }

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
    public function create(Request $request)
    {
        return view('signals.create', [
            'CP' => ControlledPoint::where('code', $request->CP)->first()
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

        do {
            $countTC = 1;
            $name = Str::of('name')->append($countTC)->append('TC');
            $klemm = Str::of('klemm')->append($countTC)->append('TC');
            $number = Str::of('number')->append($countTC)->append('TC');
            $invert = Str::of('invert')->append($countTC)->append('TC');
            $oper = Str::of('oper')->append($countTC)->append('TC');
            $DP = Str::of('DP')->append($countTC)->append('TC');
            TC::create([
                "name" => $request->$name,
                "klemm" => $request->$klemm,
                "number" => $request->$number,
                "invert" => $request->$invert,
                "oper" => $request->$oper,
                "DP" => $request->$DP,
                "cp-code" => $request->CP,
            ]);
            $countTC++;
        }
        while ($countTC++ < $request->TCcount);

        do {
            $countTY = 1;
            $name = Str::of('name')->append($countTY)->append('TY');
            $klemm = Str::of('klemm')->append($countTY)->append('TY');
            $number = Str::of('number')->append($countTY)->append('TY');
            $oper = Str::of('oper')->append($countTY)->append('TY');
            $DP = Str::of('DP')->append($countTY)->append('TY');
            TY::create([
                "name" => $request->$name,
                "klemm" => $request->$klemm,
                "number" => $request->$number,
                "oper" => $request->$oper,
                "DP" => $request->$DP,
                "cp-code" => $request->CP,
            ]);
            $countTY++;
        }
        while ($countTY++ < $request->TYcount);

        return $this->index($request)->with('success');
    }

    public function edit(Request $request)
    {
        return view('signals.edit', [
            'TC' => TC::where('cp-code', $request->CP)->get(),
            'TY' => TY::where('cp-code', $request->CP)->get(),
            'CP' => $request->CP
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
    public function update(CreateSignalRequest $request)
    {
        $TC = TC::where('cp-code', $request->CP)->get();

        foreach ($TC as $tc) {
            $name = Str::of('name')->append($tc->id)->append('TC');
            $tc->name = $request->$name;

            $klemm = Str::of('klemm')->append($tc->id)->append('TC');
            $tc->klemm = $request->$klemm;

            $number = Str::of('number')->append($tc->id)->append('TC');
            $tc->number = $request->$number;

            $invert = Str::of('invert')->append($tc->id)->append('TC');
            $tc->invert = $request->$invert;

            $oper = Str::of('oper')->append($tc->id)->append('TC');
            $tc->oper = $request->$oper;

            $DP = Str::of('DP')->append($tc->id)->append('TC');
            $tc->DP = $request->$DP;

            $tc->save();

        }

        $TY = TY::where('cp-code', $request->CP)->get();

        foreach ($TY as $ty) {
            $name = Str::of('name')->append($ty->id)->append('TY');
            $ty->name = $request->$name;

            $klemm = Str::of('klemm')->append($ty->id)->append('TY');
            $ty->klemm = $request->$klemm;

            $number = Str::of('number')->append($ty->id)->append('TY');
            $ty->number = $request->$number;

            $oper = Str::of('oper')->append($ty->id)->append('TY');
            $ty->oper = $request->$oper;

            $DP = Str::of('DP')->append($ty->id)->append('TY');
            $ty->DP = $request->$DP;

            $ty->save();

        }

        return $this->index($request)->with('success');
    }
}
