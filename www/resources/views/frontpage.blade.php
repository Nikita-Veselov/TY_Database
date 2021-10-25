@extends('layouts.main')

@section('content')

        {{-- Records --}}
    <div class="col-6 my-2 btn-group-vertical px-0">
        <button class="btn btn-primary disabled" role="button" aria-disabled="true">Протоколы</button>
        <div class="btn-group" role="group" aria-label="records">
            <a class="btn btn-outline-success col-6" href="{{ route('records.index') }}" role="button">Записи</a>
            <a class="btn btn-outline-warning col-6" href="{{ route('records.create') }}" role="button">Новый</a>
        </div>
    </div>
    <div class="w-100"></div>

        {{-- CP --}}
    <div class="col-6 my-2 btn-group-vertical px-0">
        <button class="btn btn-primary disabled" role="button" aria-disabled="true">КП</button>
        <div class="btn-group" role="group" aria-label="controlledPoints">
            <a class="btn btn-outline-success col-6" href="{{ route('controlledPoints.index') }}" role="button">Записи</a>
            <a class="btn btn-outline-warning col-6" href="{{ route('controlledPoints.create') }}" role="button">Добавить</a>
        </div>
    </div>
    <div class="w-100"></div>

        {{-- Signals --}}
    <form class="col-6 my-2 px-0" method="GET" action="{{ url('signals') }}">
        <div class="col-12 btn-group-vertical">
            <button class="btn btn-primary disabled" role="button" aria-disabled="true">Сигналы</button>
            <select class="form-select text-center" size="5" aria-label="КП" name="CP" value="{{ old('CP') }}" >
                @foreach ($CP as $cp)
                    <option value="{{ $cp->code }}">{{ $cp->type }} {{ $cp->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-outline-success">Просмотреть</button>
        </div>
    </form>
    <div class="w-100"></div>

        {{-- Workers --}}
    <div class="col-6 my-2 btn-group-vertical px-0">
        <button class="btn btn-primary disabled" role="button" aria-disabled="true">Работники</button>
        <div class="btn-group" role="group" aria-label="workers">
            <a class="btn btn-outline-success col-6" href="{{ route('workers.index') }}" role="button">Записи</a>
            <a class="btn btn-outline-warning col-6" href="{{ route('workers.create') }}" role="button">Добавить</a>
        </div>
    </div>
    <div class="w-100"></div>

        {{-- Devices --}}
    <div class="col-6 my-2 btn-group-vertical px-0">
        <button class="btn btn-primary disabled" role="button" aria-disabled="true">Приборы</button>
        <div class="btn-group" role="group" aria-label="devices">
            <a class="btn btn-outline-success col-6" href="{{ route('devices.index') }}" role="button">Записи</a>
            <a class="btn btn-outline-warning col-6" href="{{ route('devices.create') }}" role="button">Добавить</a>
        </div>
    </div>
    <div class="w-100"></div>

@endsection
