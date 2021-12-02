@extends('layouts.main')

@section('content')

{{-- Serach bar --}}
<div class="row justify-content-start">
    <div class="col-6 p-0">
        <form class="form-control" action="{{ route('searchCp') }}">
            <div class="row">
                <div class="col-8">
                    <label for="value" class="form-label">Значение</label>
                </div>
                <div class="col-4"></div>
            </div>
            <div class="row">
                <div class="col-8">
                    <input class="form-control" type="text" name="value">
                </div>
                <div class="col-4 text-center">
                    <button class="btn btn-primary" type="submit">Найти</button>
                    <a role="button" type="button" href="{{ route('controlledPoints.index') }}" class="btn btn-secondary">Сброс</a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Changeable number of rows in tables --}}
{{-- <div class="col">
    Отображаемое количество строк:
    <select name="rowsShown" id="rowsShown">
        <option value="10" selected>10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
</div> --}}

{{-- Main table --}}
<table class="table table-striped" id="data">
    <thead>
      <tr>
        <th scope="col">Код</th>
        <th scope="col">Название</th>
        <th scope="col">Тип</th>
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
                                <a type="button" class="btn btn-secondary btn-sm" href="{{ URL::to('controlledPoints/' . $controlledPoint->id . '/edit') }}" role="button">Изменит</a>
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
<div class="d-flex justify-content-center">
    <nav id="pag">
        {{-- js pagination --}}
    </nav>
</div>

<script>
    $('#rowsShown').change(function() {
        var rowsShown = $('#rowsShown option:selected').val();
        paginate(rowsShown);
    });

    $(document).ready(function(){
        var rowsShown = $('#rowsShown option:selected').val();
        paginate(rowsShown);
    });

    function paginate (rowsShown) {
        $('#pag').append('<ul class="pagination" id="nav"></ul>');
        if (rowsShown === undefined) {
            rowsShown = 10;
        }
        // count pages
        var rowsTotal = $('#data tbody tr').length;
        var numPages = rowsTotal/rowsShown;

        // nav creation
        $('#nav').empty();
        if (numPages > 1) {
            for(i = 0; i < numPages; i++) {
                var pageNum = i + 1;
                $('#nav').append('<li class="page-item"><a href="#" rel="'+i+'" class="page-link">'+pageNum+'</a></li>');
            }
        }
        $('#nav li:first').addClass('active');

        // hide excess rows
        $('#data tbody tr').hide();
        $('#data tbody tr').slice(0, rowsShown).show();

        $('#nav li').bind('click', function(){
            $('#nav li').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).children().attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
            css('display','table-row').animate({opacity:1}, 300);
        });
    }
</script>
@endsection
