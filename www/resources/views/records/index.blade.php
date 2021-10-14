@extends('layouts.main')

@section('content')

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">number</th>
        <th scope="col">type</th>
        <th scope="col">date</th>
        <th scope="col">CP</th>
        <th scope="col">device</th>
        <th scope="col">UTY</th>
        <th scope="col">UTC</th>
        <th scope="col">worker</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
            <tr>
                <th scope="row">{{ $record->number }}</th>
                <td>{{ $record->type }}</td>
                <td>{{ $record->date }}</td>
                <td>{{ $record->controlledPoint }}</td>
                <td>{{ $record->device }}</td>
                <td>{{ $record->UTY }}</td>
                <td>{{ $record->UTC }}</td>
                <td>{{ $record->worker }}</td>
                <td>
                    <div class="row btn-group" role="group" aria-label="Basic example">
                        <div class="col-3">
                            <a type="button" class="btn btn-primary" href="{{ URL::to('records/' . $record->id) }}" role="button">Show</a>
                        </div>
                        <div class="col-3">
                            <a type="button" class="btn btn-secondary" href="{{ URL::to('records/' . $record->id . '/edit') }}" role="button">Edit</a>
                        </div>
                        <div class="col-3">
                            <form class="delete" action="{{ route('records.destroy', $record->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Del</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
