@extends('layouts.main')

@section('content')

<div class="col-10 mt-3">

@if ($devices->isNotEmpty())
        {{-- Search form --}}
    <x-search-bar></x-search-bar>

        {{-- Main table --}}
    <table class="table table-striped" id="data">
        <thead>
        <tr>
            <th scope="col" class="col-1">Код</th>
            <th scope="col" class="col-4">Название</th>
            <th scope="col" class="col-2">Класс точности</th>
            <th scope="col" class="col-2">Дата поверки</th>
            @if (Auth::check())
                <th scope="col" style="width: 15%">Действия</th>
            @endif
        </tr>
        </thead>

        <tbody>
            @foreach ($devices as $device)
                <tr>
                    <td>{{ $device->code }}</td>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->class }}</td>
                    <td>{{ $device->date }}</td>
                    @if (Auth::check())
                        <td>
                            <div class="row btn-group" role="group" aria-label="Basic example">
                                <div class="col-6">
                                    <a type="button" class="btn btn-secondary btn-sm" href="{{ URL::to('devices/' . $device->id . '/edit') }}" role="button">Изменить</a>
                                </div>
                                <div class="col-6">
                                    <form class="delete" action="{{ route('devices.destroy', $device->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

        {{-- js pagination --}}
    <div id="pag"></div>
        {{-- scriptst moved to views/components/scripts for easy include in all views--}}
    <x-scripts.paginate-script></x-scripts.paginate-script>
    <x-scripts.search-script></x-scripts.search-script>

@else

<div class="row text-center pt-5">
    <div class="col-12 fs-3">Устройства не добавлены</div>
</div>

@endif

</div>

@endsection
