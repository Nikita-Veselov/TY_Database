@extends('layouts.main')

@section('content')

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">number</th>
        <th scope="col">code</th>
        <th scope="col">name</th>
        <th scope="col">type</th>
        <th scope="col">Action</th>
      </tr>
    </thead>

    <tbody>

        @foreach ($controlledPoints as $controlledPoint)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $controlledPoint->code }}</td>
                <td>{{ $controlledPoint->name }}</td>
                <td>{{ $controlledPoint->type }}</td>
                <td>
                    <a type="button" class="btn btn-secondary col" href="{{ URL::to('controlledPoints/' . $controlledPoint->id . '/edit') }}" role="button">Edit</a>
                    <form action="{{ route('controlledPoints.destroy', $controlledPoint->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger col">Del</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
