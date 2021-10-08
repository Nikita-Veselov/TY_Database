@extends('layouts.main')

@section('content')

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">worker</th>
        <th scope="col">number</th>
        <th scope="col">type</th>
        <th scope="col">date</th>
        <th scope="col">CP</th>
        <th scope="col">device</th>
        <th scope="col">UTY</th>
        <th scope="col">UTC</th>
        <th scope="col">worker</th>
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
                    <a type="button" class="btn btn-primary col" href="{{ URL::to('records/' . $record->id) }}" role="button">Show</a>
                    <a type="button" class="btn btn-secondary col" href="{{ URL::to('records/' . $record->id . '/edit') }}" role="button">Edit</a>
                    <a type="button" class="btn btn-danger col" href="{{ route('records.destroy', $record->id) }}" role="button">Del</a>
                </td>
            </tr>
        @endforeach

    </tbody>
  </table>




@endsection
