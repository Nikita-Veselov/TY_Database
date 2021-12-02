@extends('layouts.main')

@section('content')


    {{-- Search form --}}
<x-search-bar></x-search-bar>

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
        <th scope="col">Должность</th>
        <th scope="col">ФИО</th>
        <th scope="col">Подпись</th>
        @if (Auth::check())
            <th scope="col" style="width: 15%">Действия</th>
        @endif
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
                @if (Auth::check())
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
{{-- scriptst moved to views/components/scripts for easy include in all views--}}
<x-scripts.paginate-script></x-scripts.paginate-script>
<x-scripts.search-script></x-scripts.search-script>
@endsection
