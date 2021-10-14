@extends('layouts.main')

@section('content')

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Должность</th>
        <th scope="col">ФИО</th>
        <th scope="col" style="width: 15%">Действия</th>
      </tr>
    </thead>

    <tbody>

        @foreach ($workers as $worker)
            <tr>
                <td>{{ $worker->position }}</td>
                <td>{{ $worker->BIO }}</td>
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


@endsection
