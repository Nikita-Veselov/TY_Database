<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecordRequest;
use App\Models\ControlledPoint;
use App\Models\Devices;
use App\Models\Record;
use App\Models\TC;
use App\Models\TY;
use App\Models\Workers;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('records.index', [
            'records' => Record::simplePaginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('records.create', [
            'workers' => Workers::all(),
            'devices' => Devices::all(),
            'controlledPoints' => ControlledPoint::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRecordRequest $request)
    {
        Record::create([
            "number" => $request->number,
            "type" => $request->type,
            "date" => $request->date,
            "controlledPoint" => $request->controlledPoint,
            "device" => $request->device,
            "UTY" => $request->UTY,
            "UTC" => $request->UTC,
            "UTP" => $request->UTP,
            "conclusion" => $request->conclusion,
            "worker1" => $request->worker1,
            "worker2" => $request->worker2,
        ]);

        // $this->publishPDF();

        return $this->index()->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        return view('records.show', [
            'record' => $record,
            'worker1' => Workers::where('BIO', $record->worker1)->first(),
            'worker2' => Workers::where('BIO', $record->worker2)->first(),
            'device' => Devices::where('name', $record->device)->first(),
            'CP' => ControlledPoint::where('code', $record->controlledPoint)->first(),
            'TC' => TC::where('cp-code', $record->controlledPoint)->get(),
            'TY' => TY::where('cp-code', $record->controlledPoint)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        return view('records.edit', [
            'record' => $record,
            'workers' => Workers::all(),
            'devices' => Devices::all(),
            'controlledPoints' => ControlledPoint::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRecordRequest $request, Record $record)
    {

        $record = Record::find($record->id);
        $record->number = $request->number;
        $record->type = $request->type;
        $record->date = $request->date;
        $record->controlledPoint = $request->controlledPoint;
        $record->device = $request->device;
        $record->UTY = $request->UTY;
        $record->UTC = $request->UTC;
        $record->UTP = $request->UTP;
        $record->worker1 = $request->worker1;
        $record->worker2 = $request->worker2;
        $record->conclusion = $request->conclusion;
        $record->save();
        return $this->show($record)->with('success-added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        Record::destroy($record->id);
        return $this->index()->with('record-deleted');
    }

    /**
     * Seacrch for the specified record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return view('records.index', [
            'records' => Record::where($request->key, $request->value)->get()->sortBy('id')
        ]);
    }

    /**
     * PDF stuff.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function publishPDF(Request $request) {

        $record = Record::where('id', $request->record)->first();

        $pdf = SnappyPdf::loadView('records.export', [
            'record' => $record,
            'worker1' => Workers::where('BIO', $record->worker1)->first(),
            'worker2' => Workers::where('BIO', $record->worker2)->first(),
            'device' => Devices::where('name', $record->device)->first(),
            'CP' => ControlledPoint::where('code', $record->controlledPoint)->first(),
            'TC' => TC::where('cp-code', $record->controlledPoint)->get(),
            'TY' => TY::where('cp-code', $record->controlledPoint)->get(),
        ]);

        return $pdf->stream();

    }
}
