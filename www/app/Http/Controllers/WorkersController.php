<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWorkerRequest;
use App\Models\Workers;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Workers::all();
        foreach ($workers as $worker) {
            if ($worker->signature) {
                $arr = [];
                $arr = explode(' ', $worker->BIO);
                $worker->name = $arr[0];

                //соединение с фтп
                $ftp = ftp_ssl_connect(env('FTP_HOST'));
                ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
                ftp_pasv($ftp, true);

                //формирование путей
                $path = Storage::path("public/signature");
                $local_file = "$path/$worker->name.png";
                $server_file = "/upload/signature/$worker->name.png";

                //создание папки
                if (!@chdir($path)) {
                    mkdir($path);
                }
                if (!file_exists($local_file)) {
                    ftp_get($ftp, $local_file, $server_file, FTP_BINARY);
                }
            }
        }
        return view('workers.index', ['workers' => $workers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWorkerRequest $request)
    {
        $request->file('signature') ? $signature = 1 : $signature = 0;
        $BIO = $request->name1 . " " . $request->name2 . " " . $request->name3;
        Workers::create([
            'position' => $request->position,
            'BIO' => $BIO,
            'signature' => $signature
        ]);

        $this->saveSignature($request, $request->name1);

        return $this->index()->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workers  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Workers $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workers  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Workers $worker)
    {
        return view('workers.edit', ['worker' => $worker]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workers  $record
     * @return \Illuminate\Http\Response
     */
    public function update(CreateWorkerRequest $request, Workers $worker)
    {
        $BIO = $request->name1 . " " . $request->name2 . " " . $request->name3;

        $worker = Workers::find($worker->id);
        $worker->position = $request->position;
        $worker->BIO = $BIO;

        //если была добавлена новая подпись
        if ($request->file('signature')) {

            //удаление старой подписи на случай изменения имени (избежать появления дубликатов)
            $arr = explode(' ', $worker->BIO);
            $workerName = $arr[0];
            $this->deleteSignature($workerName);

            //сохранение новой
            $this->saveSignature($request);

            //пометка в БД
            $worker->signature = 1;
        }

        $worker->save();

        return $this->index()->with('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workers  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workers $worker)
    {
        Workers::destroy($worker->id);
        return $this->index()->with('flash_message', 'Post deleted!');
    }


    public function saveSignature(Request $request) {

        //сохранение в ларавел хранилище
        Storage::putFileAs('public/signature', $request->file('signature'), "$request->name1.png");

        //подключение к серверу
        $ftp = ftp_ssl_connect(env('FTP_HOST'));
        ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        ftp_pasv($ftp, true);

        //формирование путей
        $path = "signature";
        $local_file = Storage::path("public/$path/$request->name1.png");
        $server_file = "/upload/$path/$request->name1.png";

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

    public function deleteSignature($workerName) {
        $ftp = ftp_ssl_connect(env('FTP_HOST'));
        ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        ftp_pasv($ftp, true);

        @ftp_delete($ftp, "upload/signature/$workerName.png");

        ftp_close($ftp);
    }
    protected function ftp_mksubdir($ftp, $ftppath){
        // вспомогательная функция создания поддиректорий на FTP сервере
        $parts = explode('/', $ftppath);
        foreach($parts as $part){
        if(!@ftp_chdir($ftp, $part)){
            ftp_mkdir($ftp, $part);
            ftp_chdir($ftp, $part);
            }
        }
    }
}
