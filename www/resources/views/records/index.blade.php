@extends('layouts.main')

@section('content')

    {{-- Search form --}}
<div class="row justify-content-start">
    <div class="col-6 p-0">
        <form class="form-control" action="{{ route('searchRec') }}">
            <div class="row">
                <div class="col-8">
                    <label for="value" class="form-label">Значение</label>
                </div>
                <div class="col-4"></div>
            </div>
            <div class="row">
                <div class="col-8">
                    <input class="form-control" type="text" name="value" value="{{ isset($value) ? $value : '' }}">
                </div>
                <div class="col-4 text-center">
                    <button class="btn btn-primary" type="submit">Найти</button>
                    <a role="button" type="button" href="{{ route('records.index') }}" class="btn btn-secondary">Сброс</a>
                </div>
            </div>
        </form>
    </div>
</div>
    {{-- Main table --}}
<table class="table align-middle table-sm" id='data'>
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
    <nav id="pag">
        {{-- js pagination here --}}
    </nav>
</div>

<script>
    // pagination
    $(document).ready(function(){
        $('#pag').append('<ul class="pagination" id="nav"></ul>');
        var rowsShown = 10;
        var rowsTotal = $('#data tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0; i < numPages; i++) {
            var pageNum = i + 1;
            $('#nav').append('<li class="page-item"><a href="#" rel="'+i+'" class="page-link">'+pageNum+'</a></li>');
        }
        $('#data tbody tr').hide();
        $('#data tbody tr').slice(0, rowsShown).show();
        $('#nav li:first').addClass('active');
        $('#nav li').bind('click', function(){
            $('#nav li').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).children().attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
            css('display','table-row').animate({opacity:1}, 300);
        });
    });
</script>

@endsection
