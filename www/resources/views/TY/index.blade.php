@extends('layouts.main')

@section('content')




@if ( $controlledPoint )

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">number</th>
        <th scope="col">worker</th>
        <th scope="col">BIO</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($workers as $worker)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $worker->position }}</td>
                <td>{{ $worker->BIO }}</td>
                <td>
                    <a type="button" class="btn btn-secondary col" href="{{ URL::to('workers/' . $worker->id . '/edit') }}" role="button">Edit</a>
                    <form action="{{ route('workers.destroy', $worker->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger col">Del</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endif

@endsection
