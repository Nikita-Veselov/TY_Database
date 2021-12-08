<?php

namespace App\Http\Controllers;

use App\Models\ControlledPoint;
use App\Models\TC;
use App\Models\TY;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function PHPUnit\Framework\once;

class SignalController extends Controller
{
    public function index(Request $request, bool $print = false)
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
            'CP' => ControlledPoint::where('code', $request->CP)->first(),
            'print' => $print,
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

    public function store(Request $request)
    {
        $countTC = 1;
        $countTY = 1;
        do {
            $name = Str::of('name')->append($countTC)->append('TC');
            $klemm = Str::of('klemm')->append($countTC)->append('TC');
            $number = Str::of('number')->append($countTC)->append('TC');
            $invert = Str::of('invert')->append($countTC)->append('TC');
            $oper = Str::of('oper')->append($countTC)->append('TC');
            $DP = Str::of('DP')->append($countTC)->append('TC');
            if ($request->$name != null) {
                TC::create([
                    "name" => $request->$name,
                    "klemm" => $request->$klemm,
                    "number" => $request->$number,
                    "invert" => $request->$invert,
                    "oper" => $request->$oper,
                    "DP" => $request->$DP,
                    "cp-code" => $request->CP,
                ]);
            }
            $countTC++;
        }
        while ($countTC <= $request->TCcount);

        do {
            $name = Str::of('name')->append($countTY)->append('TY');
            $klemm = Str::of('klemm')->append($countTY)->append('TY');
            $number = Str::of('number')->append($countTY)->append('TY');
            $oper = Str::of('oper')->append($countTY)->append('TY');
            $DP = Str::of('DP')->append($countTY)->append('TY');
            if ($request->$name != null) {
                TY::create([
                    "name" => $request->$name,
                    "klemm" => $request->$klemm,
                    "number" => $request->$number,
                    "oper" => $request->$oper,
                    "DP" => $request->$DP,
                    "cp-code" => $request->CP,
                ]);
            }
            $countTY++;
        }
        while ($countTY <= $request->TYcount);

        return $this->index($request);
    }

    public function edit($signal)
    {
        $CP = ControlledPoint::where('code', $signal)->first();

        return view('signals.edit', [
            'TC' => TC::where('cp-code', $signal)->get(),
            'TY' => TY::where('cp-code', $signal)->get(),
            'CP' => $CP,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $TC = TC::where('cp-code', $request->CP)->get();

        foreach ($TC as $tc) {
            $name = Str::of('name')->append($tc->id)->append('TC');
            $klemm = Str::of('klemm')->append($tc->id)->append('TC');
            $number = Str::of('number')->append($tc->id)->append('TC');
            $invert = Str::of('invert')->append($tc->id)->append('TC');
            $oper = Str::of('oper')->append($tc->id)->append('TC');
            $DP = Str::of('DP')->append($tc->id)->append('TC');

            if ($request->$name != null) {
                $tc->name = $request->$name;
                $tc->klemm = $request->$klemm;
                $tc->invert = $request->$invert;
                $tc->number = $request->$number;
                $tc->oper = $request->$oper;
                $tc->DP = $request->$DP;

                $tc->save();
                $countTC = $tc->id;
            }
        }

        if ($request->TCcount > $countTC) {

            do {
                $countTC++;
                $name = Str::of('name')->append($countTC)->append('TC');
                $klemm = Str::of('klemm')->append($countTC)->append('TC');
                $number = Str::of('number')->append($countTC)->append('TC');
                $invert = Str::of('invert')->append($countTC)->append('TC');
                $oper = Str::of('oper')->append($countTC)->append('TC');
                $DP = Str::of('DP')->append($countTC)->append('TC');

                if ($request->$name != null) {
                    TC::create([
                        "name" => $request->$name,
                        "klemm" => $request->$klemm,
                        "number" => $request->$number,
                        "invert" => $request->$invert,
                        "oper" => $request->$oper,
                        "DP" => $request->$DP,
                        "cp-code" => $request->CP,
                    ]);
                }

            } while ($countTC < $request->TCcount);
        }

        $TY = TY::where('cp-code', $request->CP)->get();

        foreach ($TY as $ty) {
            $name = Str::of('name')->append($ty->id)->append('TY');
            $klemm = Str::of('klemm')->append($ty->id)->append('TY');
            $number = Str::of('number')->append($ty->id)->append('TY');
            $oper = Str::of('oper')->append($ty->id)->append('TY');
            $DP = Str::of('DP')->append($ty->id)->append('TY');

            if ($request->$name != null) {
                $ty->name = $request->$name;
                $ty->klemm = $request->$klemm;
                $ty->number = $request->$number;
                $ty->oper = $request->$oper;
                $ty->DP = $request->$DP;

                $ty->save();
                $countTY = $ty->id;
            }
        }

        if ($request->TYcount > $countTY) {
            do {
                $countTY++;
                $name = Str::of('name')->append($countTY)->append('TY');
                $klemm = Str::of('klemm')->append($countTY)->append('TY');
                $number = Str::of('number')->append($countTY)->append('TY');
                $oper = Str::of('oper')->append($countTY)->append('TY');
                $DP = Str::of('DP')->append($countTY)->append('TY');
                if ($request->$name != null) {
                    TY::create([
                        "name" => $request->$name,
                        "klemm" => $request->$klemm,
                        "number" => $request->$number,
                        "oper" => $request->$oper,
                        "DP" => $request->$DP,
                        "cp-code" => $request->CP,
                    ]);
                }
            } while ($countTY < $request->TYcount);
        }

        return $this->index($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->sig === "TC") {
            TC::destroy($request->id);
            return $this->index($request)->with('success', 'TC instance deleted');
        } elseif ($request->sig === "TY") {
            TY::destroy($request->id);
            return $this->index($request)->with('success', 'TY instance deleted');
        } else {
            return $this->index($request)->withErrors('Deletion aborted');
        }
    }

    public function print(Request $request) {
        $pdf = SnappyPdf::loadView('signals.export', [
            'code' => $request->CP,
            'TC' => TC::where('cp-code', $request->CP)->get(),
            'TY' => TY::where('cp-code', $request->CP)->get(),
            'CP' => ControlledPoint::where('code', $request->CP)->first()
        ]);

        $pdf->save("tmp/tmp.pdf", true);
        return $this->index($request, true);
    }
}
