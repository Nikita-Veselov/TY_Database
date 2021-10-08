@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row text-center">
        <div class="col-12">{{ $record->number }}</div>
        <div class="col-12">{{ $record->type }}</div>
        <div class="col-12">{{ $record->date }}</div>
        <div class="col-12">{{ $record->controlledPoint }}</div>
        <div class="col-12">{{ $record->device }}</div>
        <div class="col-12">{{ $record->UTY }}</div>
        <div class="col-12">{{ $record->UTC }}</div>
        <div class="col-12">{{ $record->worker }}</div>
    </div>
</div>


@endsection
