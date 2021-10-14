@extends('layouts.main')

@section('content')

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
                    <div class="row btn-group" role="group" aria-label="Basic example">
                        <div class="col-6">
                            <a type="button" class="btn btn-secondary" href="{{ URL::to('workers/' . $worker->id . '/edit') }}" role="button">Edit</a>
                        </div>
                        <div class="col-6">
                            <form class="delete" action="{{ route('workers.destroy', $worker->id) }}" method="POST">
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
