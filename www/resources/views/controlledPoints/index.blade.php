@extends('layouts.main')

@section('content')

@foreach ($controlledPoints as $CP)
    <div class="row">
        <div class="col-4">{{ $CP->code; }}</div>
        <div class="col-4">{{ $CP->name; }}</div>
        <div class="col-4">{{ $CP->type; }}</div>
    </div>

@endforeach

@endsection
