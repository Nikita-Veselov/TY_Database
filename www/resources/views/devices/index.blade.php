@extends('layouts.main')

@section('content')

@foreach ($devices as $device)
    <div class="row">
        <div class="col-3">{{ $device->code; }}</div>
        <div class="col-3">{{ $device->name; }}</div>
        <div class="col-3">{{ $device->class; }}</div>
        <div class="col-3">{{ $device->date; }}</div>
    </div>

@endforeach

@endsection
