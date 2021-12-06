@extends('layouts.main')

@section('content')

<div class="col-12 mt-3">

@if ($records->isNotEmpty())

    {{-- Search form --}}
    <x-search-bar></x-search-bar>

        {{-- Main table --}}
    <table class="table align-middle table-sm" id='data'>
        <thead>
        <tr>
            <th scope="col" class="col-1">Номер</th>
            <th scope="col" class="col-1">Номер КП</th>
            <th scope="col" class="col-4">КП</th>
            <th scope="col" class="col-2">Тип</th>
            <th scope="col" class="col-2">Дата</th>
            <th scope="col" class="col-2">Действия</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->number }}</td>
                    <td>{{ $record->controlledPoint}}</td>
                    <td>
                        {{ $CP->where('code', $record->controlledPoint)->first()->name }}
                        ({{ $CP->where('code', $record->controlledPoint)->first()->type }})
                    </td>
                    <td>{{ $record->type }}</td>
                    <td>{{ $record->date }}</td>
                    <td>
                        <div class="row btn-group" role="group">
                            <a type="button" class="col-2 btn btn-primary btn-sm m-0 py-1 px-0" href="{{ URL::to('records/' . $record->id) }}" role="button"><img class="img-fluid w-50" src="{{ asset('/img/icons/Show.png') }}" alt=""></a>
                            <a type="button" class="col-2 btn btn-success btn-sm m-0 py-1 px-0" href="{{ route('openPDF', ['record' => $record->id, 'opt' => 'PDF' ]) }}" role="button" target="_blank"><img class="img-fluid w-50" src="{{ asset('/img/icons/PDF.png') }}" alt=""></a>
                            <a type="button" class="col-2 btn btn-warning btn-sm m-0 py-1 px-0" href="{{ route('openPDF', ['record' => $record->id, 'opt' => 'Print' ]) }}" role="button" target="_blank"><img class="img-fluid w-50" src="{{ asset('/img/icons/Printer.png') }}" alt=""></a>
                            @if (Auth::check())
                                <a type="button" class="col-2 btn btn-secondary btn-sm m-0 py-1 px-0" href="{{ URL::to('records/' . $record->id . '/edit') }}" role="button"><img class="img-fluid w-50" src="{{ asset('/img/icons/Edit.png') }}" alt=""></a>
                                <form class="col-2 btn btn-danger btn-sm delete m-0 py-1 px-0" action="{{ route('records.destroy', $record->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm m-0 p-0"><img class="img-fluid w-50" src="{{ asset('/img/icons/Delete.png') }}" alt=""></button>
                                </form>
                            @else
                                <div class="col-4"></div>
                            @endif
                        </div>
                    </td>
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
    <div class="col-12 fs-3">Протокола не добавлены</div>
</div>

@endif

</div>

@endsection
