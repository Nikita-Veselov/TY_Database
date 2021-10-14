@extends('layouts.main')

@section('content')

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
                        <option value="controlledPoint">КП</option>
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
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Номер</th>
        <th scope="col">Тип</th>
        <th scope="col">Дата</th>
        <th scope="col">Номер КП</th>
        <th scope="col">Работник 1</th>
        <th scope="col">Работник 2</th>
        <th scope="col" style="width: 20%">Действия</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
            <tr>
                <th scope="row">{{ $record->number }}</th>
                <td>{{ $record->type }}</td>
                <td>{{ $record->date }}</td>
                <td>{{ $record->controlledPoint }}</td>
                <td>{{ $record->worker1 }}</td>
                <td>{{ $record->worker2 }}</td>
                <td>
                    <div class="row btn-group" role="group" aria-label="Basic example">
                        <div class="col-4">
                            <a type="button" class="btn btn-primary btn-sm" href="{{ URL::to('records/' . $record->id) }}" role="button">Показать</a>
                        </div>
                        <div class="col-3">
                            <a type="button" class="btn btn-secondary btn-sm" href="{{ URL::to('records/' . $record->id . '/edit') }}" role="button">Редакт.</a>
                        </div>
                        <div class="col-4">
                            <form class="delete" action="{{ route('records.destroy', $record->id) }}" method="POST">
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
    {{  $records->render()  }}
</div>
@endsection
