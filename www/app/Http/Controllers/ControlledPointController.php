<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateControlledPointRequest;
use App\Models\ControlledPoint;
use App\Models\Record;
use App\Models\TC;
use App\Models\TY;
use Illuminate\Http\Request;

class ControlledPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('controlledPoints.index', [
            'controlledPoints' => ControlledPoint::all()->sortBy('name')
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
        return view('controlledPoints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateControlledPointRequest $request)
    {
        ControlledPoint::create([
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
        ]);
        return $this->index()->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devices  $record
     * @return \Illuminate\Http\Response
     */
    public function show(ControlledPoint $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devices  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(ControlledPoint $controlledPoint)
    {
        return view('controlledPoints.edit', ['controlledPoint' => $controlledPoint]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Devices  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ControlledPoint $controlledPoint)
    {
        // Update all codes in all records contining this CP
        $records = Record::where('controlledPoint', $controlledPoint->code)->get();
        foreach ($records as $record) {
            $record->controlledPoint = $request->code;
            $record->save();
        }

        $controlledPoint = ControlledPoint::find($controlledPoint->id);
        $controlledPoint->code = $request->code;
        $controlledPoint->name = $request->name;
        $controlledPoint->type = $request->type;
        $controlledPoint->save();
        return $this->index()->with('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devices  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControlledPoint $controlledPoint)
    {
        ControlledPoint::destroy($controlledPoint->id);
        return $this->index()->with('flash_message', 'controlledPoint deleted!');
    }

    public function search(Request $request)
    {
        return view('controlledPoints.index', [
            'controlledPoints' => ControlledPoint::where($request->key, $request->value)->get()->sortBy('id')
        ]);
    }
}
