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
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Rawilk\Printing\Facades\Printing;

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

        return $this->show($record, true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record, bool $print = false)
    {
        return view('records.show', [
            'record' => $record,
            'worker1' => Workers::where('BIO', $record->worker1)->first(),
            'worker2' => Workers::where('BIO', $record->worker2)->first(),
            'device' => Devices::where('name', $record->device)->first(),
            'CP' => ControlledPoint::where('code', $record->controlledPoint)->first(),
            'TC' => TC::where('cp-code', $record->controlledPoint)->get(),
            'TY' => TY::where('cp-code', $record->controlledPoint)->get(),
            'print' => $print,
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

        $ftp = ftp_ssl_connect(env('FTP_HOST'));
        ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        ftp_pasv($ftp, true);

        @ftp_delete($ftp, "upload/recordsPDF/$route/$name.pdf");

        ftp_close($ftp);

        $ftp = ftp_ssl_connect(env('FTP_HOST'));
        ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        ftp_pasv($ftp, true);

        @ftp_delete($ftp, "upload/recordsPrint/$route/$name.pdf");

        ftp_close($ftp);

            //Save new as PDF
        $this->publishPDF($record);

        return $this->show($record, true);
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
        if ($request->key === 'CPname') {
            $key = ControlledPoint::where('name', 'like', '%'.$request->value.'%')->get();
            $arr = [];
            foreach ($key as $code) {
                array_push($arr, $code->code);
            };
            return view('records.index', [
                'records' => Record::whereIn('controlledPoint', $arr)->orderBy('id')->simplePaginate(10),
                'CP' => ControlledPoint::all(),
            ]);
        }
        return view('records.index', [
            'records' => Record::where($request->key, '%'.$request->value.'%')->orderBy('id')->simplePaginate(10),
            'CP' => ControlledPoint::all(),
        ]);
    }

    /**
     * PDF stuff.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */

    public function publishPDF(Record $record) {
        //формирование имени файла
        $CP = ControlledPoint::where('code', $record->controlledPoint)->first();
        $record->type == "Опробование"
            ? ($type = "Опр")
            : ($record->type == "Профвосстановление" ? $type = "Профв" : $type = "Профк");
        $name = "$type " . "$CP->type " . "$CP->name " . "($record->date)";

        //подключение к серверу
        $ftp = ftp_ssl_connect(env('FTP_HOST'));
        ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        ftp_pasv($ftp, true);

        //создание и сохранение пдф
        $pdf = SnappyPdf::loadView('records.export', [
            'record' => $record,
            'worker1' => Workers::where('BIO', $record->worker1)->first(),
            'worker2' => Workers::where('BIO', $record->worker2)->first(),
            'device' => Devices::where('name', $record->device)->first(),
            'CP' => $CP,
            'TC' => TC::where('cp-code', $record->controlledPoint)->get(),
            'TY' => TY::where('cp-code', $record->controlledPoint)->get(),
        ]);
        $pdf->save("tmp/tmp.pdf", true);

        //формирование путей
        $path = "recordsPDF/$CP->name";
        $local_file = 'tmp/tmp.pdf';
        $server_file = "/upload/$path/$name.pdf";

        //создание поддиректорий
        if (!@ftp_chdir($ftp, $path)) {
            $ftppath = 'upload/' . $path;
            $this->ftp_mksubdir($ftp, $ftppath);
        }

        //загрузка на сервер
        if (!ftp_put($ftp, $server_file, $local_file, FTP_BINARY)) {
            return back()->withErrors('Сохранение не удалось');
        }

        //закрытие сессии
        ftp_close($ftp);

        //подключение к серверу
        $ftp = ftp_ssl_connect(env('FTP_HOST'));
        ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        ftp_pasv($ftp, true);

        //создание и сохранение пдф для печати
        $pdfPrint = SnappyPdf::loadView('records.exportPrint', [
            'record' => $record,
            'worker1' => Workers::where('BIO', $record->worker1)->first(),
            'worker2' => Workers::where('BIO', $record->worker2)->first(),
            'device' => Devices::where('name', $record->device)->first(),
            'CP' => $CP,
            'TC' => TC::where('cp-code', $record->controlledPoint)->get(),
            'TY' => TY::where('cp-code', $record->controlledPoint)->get(),
        ]);
        $pdfPrint->save("tmp/tmp.pdf", true);

        //формирование путей
        $path = "recordsPrint/$CP->name";
        $local_file = 'tmp/tmp.pdf';
        $server_file = "/upload/$path/$name.pdf";

        //создание поддиректорий
        if (!@ftp_chdir($ftp, $path)) {
            $ftppath = 'upload/' . $path;
            $this->ftp_mksubdir($ftp, $ftppath);
        }

        //загрузка на сервер
        if (!ftp_put($ftp, $server_file, $local_file, FTP_BINARY)) {
            return back()->withErrors('Сохранение не удалось');
        }
        //закрытие сессии
        ftp_close($ftp);
    }

    public function openPDF(Request $request, Record $record) {
        $CP = ControlledPoint::where('code', $record->controlledPoint)->first();
        // dd($request->opt);
        $record->type == "Опробование"
            ? ($type = "Опр")
            : ($record->type == "Профвосстановление" ? $type = "Профв" : $type = "Профк");

        if ($request->opt == 'Print') {
            $route = "recordsPrint/$CP->name";
        } elseif ($request->opt == 'PDF') {
            $route = "recordsPDF/$CP->name";
        }
        $name = "$type " . "$CP->type " . "$CP->name " . "($record->date)";

        $local_file = 'tmp/tmp.pdf';
        $server_file = "upload/$route/$name.pdf";

        $ftp = ftp_ssl_connect(env('FTP_HOST'));
        ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));

        // попытка скачать $server_file и сохранить в $local_file
        if (ftp_get($ftp, $local_file, $server_file, FTP_BINARY)) {
            if (File::isFile("tmp/tmp.pdf")) {
                $file = File::get("tmp/tmp.pdf");
                $response = Response::make($file, 200);
                $response->header('Content-Type', 'application/pdf');

                return $response;
            }
        } else {
            return back()->withErrors('Не удалось открыть файл');
        }

        // закрытие соединения
        ftp_close($ftp);
    }

    protected function ftp_mksubdir($ftp, $ftppath){
        $parts = explode('/', $ftppath);
        foreach($parts as $part){
        if(!@ftp_chdir($ftp, $part)){
            ftp_mkdir($ftp, $part);
            ftp_chdir($ftp, $part);
            }
        }
    }
}
