@extends('layouts.main')

@section('content')



<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Должность</th>
        <th scope="col">ФИО</th>
        <th scope="col">Подпись</th>
        <th scope="col" style="width: 15%">Действия</th>
      </tr>
    </thead>

    <tbody>

        @foreach ($workers as $worker)
            @php
                $arr = [];
                $arr = explode(' ', $worker->BIO);
                $worker->name = $arr[0];
            @endphp
            <tr>
                <td>{{ $worker->position }}</td>
                <td>{{ $worker->BIO }}</td>
                <td>
                    @if ($worker->signature)
                        <img style="width: 3rem" src="{{ Storage::url("signature/$worker->name.png") }}" alt="" >
                    @else
                        Нет подписи
                    @endif
                </td>
                <td>
                    <div class="row btn-group" role="group">
                        <div class="col-6">
                            <a type="button" class="btn btn-secondary btn-sm" href="{{ URL::to('workers/' . $worker->id . '/edit') }}" role="button">Изменить</a>
                        </div>
                        <div class="col-6">
                            <form class="delete" action="{{ route('workers.destroy', $worker->id) }}" method="POST">
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
