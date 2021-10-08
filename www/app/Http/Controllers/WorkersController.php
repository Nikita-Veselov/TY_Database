<?php

namespace App\Http\Controllers;

use App\Exports\WorkersExport;
use App\Http\Requests\CreateWorkerRequest;
use App\Models\Workers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('workers.index', ['workers' => Workers::all()]);
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
        $BIO = $request->name1 . " " . $request->name2 . " " . $request->name3;
        Workers::create([
            'position' => $request->position,
            'BIO' => $BIO
        ]);
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
        // dd('destroyed', $worker);
        Workers::destroy($worker->id);
        return $this->index()->with('flash_message', 'Post deleted!');
    }


}