@extends('layouts.main')

@section('content')
        {{-- Records --}}
    <div class="col-5 my-2 btn-group-vertical pt-5">
        <button class="btn btn-primary disabled" role="button" aria-disabled="true">Протоколы</button>
        <div class="btn-group" role="group" aria-label="records">
            <a class="btn btn-outline-success col-6" href="{{ route('records.index') }}" role="button">Записи</a>
            <a class="btn btn-outline-warning col-6" href="{{ route('records.create') }}" role="button">Новый</a>
        </div>
    </div>
    <div class="w-100"></div>

        {{-- CP --}}
    <div class="col-5 my-2 btn-group-vertical">
        <button class="btn btn-primary disabled" role="button" aria-disabled="true">КП</button>
        <div class="btn-group" role="group" aria-label="controlledPoints">
            <a class="btn btn-outline-success col-6" href="{{ route('controlledPoints.index') }}" role="button">Записи</a>
            @if (Auth::check())
                <a class="btn btn-outline-warning col-6" href="{{ route('controlledPoints.create') }}" role="button">Добавить</a>
            @endif
        </div>
    </div>
    <div class="w-100"></div>

        {{-- Signals --}}
    <form class="col-5 my-2" method="GET" action="{{ url('signals') }}">
        <div class="col-12 btn-group-vertical">
            <button class="btn btn-primary disabled" role="button" aria-disabled="true">Сигналы</button>

            <div class="input-group">
                <span class="input-group-text">Поиск КП:</span>
                <input type="text" class="form-control" aria-label="search" id="search" name="search" onkeyup="filter()">
            </div>

            <select id="select" class="form-select text-center" size="5" aria-label="КП" name="CP" value="{{ old('CP') }}" >
                @foreach ($CP as $cp)
                    <option value="{{ $cp->code }}">{{ $cp->type }} {{ $cp->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-outline-success">Просмотреть</button>
        </div>
    </form>
    <div class="w-100"></div>

        {{-- Workers --}}
    <div class="col-5 my-2 btn-group-vertical">
        <button class="btn btn-primary disabled" role="button" aria-disabled="true">Работники</button>
        <div class="btn-group" role="group" aria-label="workers">
            <a class="btn btn-outline-success col-6" href="{{ route('workers.index') }}" role="button">Записи</a>

            @if (Auth::check())
                <a class="btn btn-outline-warning col-6" href="{{ route('workers.create') }}" role="button">Добавить</a>
            @endif
        </div>
    </div>
    <div class="w-100"></div>

        {{-- Devices --}}
    <div class="col-5 my-2 btn-group-vertical pb-5">
        <button class="btn btn-primary disabled" role="button" aria-disabled="true">Приборы</button>
        <div class="btn-group" role="group" aria-label="devices">
            <a class="btn btn-outline-success col-6" href="{{ route('devices.index') }}" role="button">Записи</a>
            @if (Auth::check())
                <a class="btn btn-outline-warning col-6" href="{{ route('devices.create') }}" role="button">Добавить</a>
            @endif
        </div>
    </div>
    <div class="w-100"></div>

        {{-- Live search for CP --}}
    <script>
        function filter() {
            var keyword = document.getElementById("search").value.toLowerCase();
            var select = document.getElementById("select");
            for (var i = 0; i < select.length; i++) {
                var txt = select.options[i].text.toLowerCase();
                if (!txt.match(keyword)) {
                    $(select.options[i]).attr('disabled', 'disabled').hide();
                } else {
                    $(select.options[i]).removeAttr('disabled').show();
                }
            }
        }
    </script>
@endsection
