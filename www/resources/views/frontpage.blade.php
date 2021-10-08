@extends('layouts.main')

@section('content')

    <div class="row justify-content-center">
        <div class="col-6 my-2 btn-group-vertical px-0">
            <button class="btn btn-outline-secondary disabled" role="button" aria-disabled="true">Протоколы</button>
            <div class="btn-group" role="group" aria-label="records">
                <a type="button" class="btn btn-primary col-4" href="{{ route('records.index') }}" role="button">Записи</a>
                <a type="button" class="btn btn-primary col-4" href="{{ route('records.create') }}" role="button">Новый</a>
                <a type="button" class="btn btn-primary col-4" href="#" role="button">Поиск</a>
            </div>
        </div>
        <div class="w-100"></div>

        <div class="col-6 my-2 btn-group-vertical px-0">
            <button class="btn btn-outline-secondary disabled" role="button" aria-disabled="true">Работники</button>
            <div class="btn-group" role="group" aria-label="workers">
                <a type="button" class="btn btn-primary col-6" href="{{ route('workers.index') }}" role="button">Просмотреть</a>
                <a type="button" class="btn btn-primary col-6" href="{{ route('workers.create') }}" role="button">Добавить</a>
            </div>
        </div>
        <div class="w-100"></div>

        <div class="col-6 my-2 btn-group-vertical px-0">
            <button class="btn btn-outline-secondary disabled" role="button" aria-disabled="true">Приборы</button>
            <div class="btn-group" role="group" aria-label="devices">
                <a type="button" class="btn btn-primary col-6" href="{{ route('devices.index') }}" role="button">Просмотреть</a>
                <a type="button" class="btn btn-primary col-6" href="{{ route('devices.create') }}" role="button">Добавить</a>
            </div>
        </div>
        <div class="w-100"></div>

        <div class="col-6 my-2 btn-group-vertical px-0">
            <button class="btn btn-outline-secondary disabled" role="button" aria-disabled="true">КП</button>
            <div class="btn-group" role="group" aria-label="controlledPoints">
                <a type="button" class="btn btn-primary col-6" href="{{ route('controlledPoints.index') }}" role="button">Просмотреть</a>
                <a type="button" class="btn btn-primary col-6" href="{{ route('controlledPoints.create') }}" role="button">Добавить</a>
            </div>
        </div>
        <div class="w-100"></div>
    </div>

    <a type="button" class="btn btn-primary col-6" href="users/export/" role="button">Добавить</a>
@endsection
