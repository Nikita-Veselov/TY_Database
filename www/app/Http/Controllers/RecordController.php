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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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
            'records' => Record::simplePaginate(10),
            'CP' => ControlledPoint::all()
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
        $record = Record::create([
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

        $this->publishPDF($record);

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
    public function update(Request $request, Record $record)
    {
            // Setting variables to generate path to file before updating the record
        $CP = ControlledPoint::where('code', $request->controlledPoint)->first();
        $record->type == "Опробование"
            ? ($type = "Опр")
            : ($record->type == "Профвосстановление" ? $type = "Профв" : $type = "Профк");
        $route = "$CP->name";
        $name = "$type " . "$CP->type " . "$CP->name " . "($record->date)";

            // Updating the record
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

            //Deleting previous file to prevent doubling from changing name date or type etc.
        File::delete("recordsPDF/$route/$name.pdf");

            //Save new as PDF
        $this->publishPDF($record);

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
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */

    public function publishPDF(Record $record) {

        $CP = ControlledPoint::where('code', $record->controlledPoint)->first();

        $pdf = SnappyPdf::loadView('records.export', [
            'record' => $record,
            'worker1' => Workers::where('BIO', $record->worker1)->first(),
            'worker2' => Workers::where('BIO', $record->worker2)->first(),
            'device' => Devices::where('name', $record->device)->first(),
            'CP' => $CP,
            'TC' => TC::where('cp-code', $record->controlledPoint)->get(),
            'TY' => TY::where('cp-code', $record->controlledPoint)->get(),
        ]);

        $record->type == "Опробование"
            ? ($type = "Опр")
            : ($record->type == "Профвосстановление" ? $type = "Профв" : $type = "Профк");

        $route = "recordsPDF/$CP->name";
        $name = "$type " . "$CP->type " . "$CP->name " . "($record->date)";

        $pdf->save("$route/$name.pdf", true);

    }

    public function openPDF(Record $record) {
        $CP = ControlledPoint::where('code', $record->controlledPoint)->first();

        $record->type == "Опробование"
            ? ($type = "Опр")
            : ($record->type == "Профвосстановление" ? $type = "Профв" : $type = "Профк");

        $route = "recordsPDF/$CP->name";
        $name = "$type " . "$CP->type " . "$CP->name " . "($record->date)";


        if (File::isFile("$route/$name.pdf"))
        {
            $file = File::get("$route/$name.pdf");
            $response = Response::make($file, 200);
            // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
            $response->header('Content-Type', 'application/pdf');

            return $response;
        }
    }
}
