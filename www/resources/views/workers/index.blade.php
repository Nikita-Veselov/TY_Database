@extends('layouts.main')

@section('content')

@foreach ($workers as $worker)
    <div class="row">
        <div class="col-6">{{ $worker->BIO; }}</div>
        <div class="col-4">{{ $worker->position; }}</div>
    </div>

@endforeach

@endsection
