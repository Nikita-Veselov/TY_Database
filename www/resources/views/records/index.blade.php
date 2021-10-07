@extends('layouts.main')

@section('content')

@foreach ($records as $record)
    <div class="row">
        <div class="col-3">{{ $record->1; }}</div>
        <div class="col-3">{{ $record->2; }}</div>
        <div class="col-3">{{ $record->3; }}</div>
        <div class="col-3">{{ $record->4; }}</div>
    </div>

@endforeach

@endsection
