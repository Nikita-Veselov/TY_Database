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
                <td>
                    <div class="col btn-group btn-group-sm" role="group" aria-label="tc">
                        <a type="button" class="btn btn-primary col" href="{{ route('tc.create', $controlledPoint->id) }}" role="button">Доб ТС</a>
                        <a type="button" class="btn btn-secondary col" href="{{ route('tc.edit', $controlledPoint->id) }}" role="button">Изм ТС</a>
                    </div>
                    <div class="col btn-group btn-group-sm" role="group" aria-label="ty">
                        <a type="button" class="btn btn-primary col" href="{{ route('ty.create', $controlledPoint->id) }}" role="button">Доб ТУ</a>
                        <a type="button" class="btn btn-secondary col" href="{{ route('ty.edit', $controlledPoint->id) }}" role="button">Изм ТУ</a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
