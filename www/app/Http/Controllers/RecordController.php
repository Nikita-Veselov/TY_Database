<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecordRequest;
use App\Models\ControlledPoint;
use App\Models\Devices;
use App\Models\Record;
use App\Models\TC;
use App\Models\TY;
use App\Models\Workers;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('records.index', ['records' => Record::all()]);
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
            "worker" => $request->worker,
        ]);
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
            'workers' => Workers::all(),
            'devices' => Devices::all(),
            'device' => Devices::where('name', $record->device)->first(),
            'controlledPoints' => ControlledPoint::all(),
            'TC' => TC::all(),
            'TY' => TY::all(),
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
        $record->worker = $request->worker;
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
}
