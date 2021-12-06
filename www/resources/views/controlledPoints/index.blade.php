@extends('layouts.main')

@section('content')

<div class="col-10 mt-3">

@if ($controlledPoints->isNotEmpty())

        {{-- Search form --}}
    <x-search-bar></x-search-bar>
        {{-- Main table --}}
    <table class="table table-striped" id="data">
        <thead>
        <tr>
            <th scope="col" class="col-1">Код</th>
            <th scope="col" class="col-5">Название</th>
            <th scope="col" class="col-3">Тип</th>
            @if (Auth::check())
                <th scope="col" style="width: 15%">Действия</th>
            @endif
        </tr>
        </thead>

        <tbody>
            @foreach ($controlledPoints as $controlledPoint)
                <tr>
                    <td>{{ $controlledPoint->code }}</td>
                    <td>{{ $controlledPoint->name }}</td>
                    <td>{{ $controlledPoint->type }}</td>
                    @if (Auth::check())
                        <td class="w-15">
                            <div class="row btn-group" role="group" aria-label="Basic example">
                                <div class="col-6">
                                    <a type="button" class="btn btn-secondary btn-sm" href="{{ URL::to('controlledPoints/' . $controlledPoint->id . '/edit') }}" role="button">Изменить</a>
                                </div>
                                <div class="col-6">
                                    <form class="delete" action="{{ route('controlledPoints.destroy', $controlledPoint->id) }}" method="POST">
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

    <div id="pag"></div>

        {{-- scriptst moved to views/components/scripts for easy include in all views--}}
    <x-scripts.paginate-script></x-scripts.paginate-script>
    <x-scripts.search-script></x-scripts.search-script>

@else

<div class="row text-center pt-5">
    <div class="col-12 fs-3">КП не добавлены</div>
</div>

@endif

</div>
@endsection
