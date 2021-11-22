@extends('layouts.main')

@section('content')

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Код</th>
        <th scope="col">Название</th>
        <th scope="col">Класс точности</th>
        <th scope="col">Дата поверки</th>
        <th scope="col" style="width: 15%">Действия</th>
      </tr>
    </thead>

    <tbody>
        @foreach ($devices as $device)
            <tr>
                <td>{{ $device->code }}</td>
                <td>{{ $device->name }}</td>
                <td>{{ $device->class }}</td>
                <td>{{ $device->date }}</td>
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
