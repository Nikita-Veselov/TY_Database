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


@endsection
