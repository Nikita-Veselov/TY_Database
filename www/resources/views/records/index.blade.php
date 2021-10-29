@extends('layouts.main')

@section('content')

    {{-- Search form --}}
<div class="row justify-content-start">
    <div class="col-8">
        <form class="form-control" action="{{ route('searchRec') }}">
            <div class="row">
                <div class="col">
                    <label for="key" class="form-label">Столбец</label>
                </div>
                <div class="col">
                    <label for="value" class="form-label">Значение</label>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row">
                <div class="col">
                    <select class="form-select" name="key">
                        <option value="CPname">КП</option>
                        <option value="type">Тип</option>
                        <option value="number">Номер</option>
                    </select>
                </div>
                <div class="col">
                    <input class="form-control" type="text" name="value">
                </div>
                <div class="col-3 text-center">
                    <button class="btn btn-primary" type="submit">Найти</button>
                    <a role="button" type="button" href="{{ route('records.index') }}" class="btn btn-secondary">Сброс</a>
                </div>
            </div>
        </form>
    </div>
</div>
    {{-- Main table --}}
<table class="table align-middle">
    <thead>
      <tr>
        <th scope="col" class="sort">Номер</th>
        <th scope="col" class="sort">КП</th>
        <th scope="col" class="sort">Номер КП</th>
        <th scope="col" class="sort">Тип</th>
        <th scope="col" class="sort">Дата</th>
        <th scope="col" class="col-2">Действия</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
            <tr>
                <td>{{ $record->number }}</td>
                <td>
                    {{ $CP->where('code', $record->controlledPoint)->first()->name }}
                    ({{ $CP->where('code', $record->controlledPoint)->first()->type }})
                </td>
                <td>{{ $record->controlledPoint}}</td>
                <td>{{ $record->type }}</td>
                <td>{{ $record->date }}</td>
                <td>
                    <div class="row btn-group" role="group">
                        <a type="button" class="col-2 btn btn-primary btn-sm m-0 py-1 px-0" href="{{ URL::to('records/' . $record->id) }}" role="button"><img class="img-fluid w-50" src="{{ asset('/img/icons/Show.png') }}" alt=""></a>
                        <a type="button" class="col-2 btn btn-secondary btn-sm m-0 py-1 px-0" href="{{ URL::to('records/' . $record->id . '/edit') }}" role="button"><img class="img-fluid w-50" src="{{ asset('/img/icons/Edit.png') }}" alt=""></a>
                        <a type="button" class="col-2 btn btn-success btn-sm m-0 py-1 px-0" href="{{ route('openPDF', ['record' => $record->id, 'opt' => 'PDF' ]) }}" role="button" target="_blank"><img class="img-fluid w-50" src="{{ asset('/img/icons/PDF.png') }}" alt=""></a>
                        <a type="button" class="col-2 btn btn-warning btn-sm m-0 py-1 px-0" href="{{ route('openPDF', ['record' => $record->id, 'opt' => 'Print' ]) }}" role="button" target="_blank"><img class="img-fluid w-50" src="{{ asset('/img/icons/Printer.png') }}" alt=""></a>
                        <form class="col-2 btn btn-danger btn-sm delete m-0 py-1 px-0" action="{{ route('records.destroy', $record->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm m-0 p-0"><img class="img-fluid w-50" src="{{ asset('/img/icons/Delete.png') }}" alt=""></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{  $records->render()  }}
</div>

<script>
    // sorting main table on cell value comparisson
    $('document').ready(function(){
        const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

        // comparing logic
        const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
            v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
            )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));


        document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
            // adding sorting symbol
        document.querySelectorAll('th').forEach(th => th.classList.remove('headerSorted'));
        th.classList.add('headerSorted');

            // reordering table
        const table = th.closest('table');
        const tbody = table.querySelector('tbody');
        Array.from(tbody.querySelectorAll('tr'))
            .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
            .forEach(tr => tbody.appendChild(tr) );
        })));
    });
</script>

<style>


</style>
@endsection
