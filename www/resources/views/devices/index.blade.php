@extends('layouts.main')

@section('content')

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">number</th>
        <th scope="col">code</th>
        <th scope="col">name</th>
        <th scope="col">class</th>
        <th scope="col">date</th>
        <th scope="col">action</th>
      </tr>
    </thead>

    <tbody>
        @foreach ($devices as $device)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $device->code }}</td>
                <td>{{ $device->name }}</td>
                <td>{{ $device->class }}</td>
                <td>{{ $device->date }}</td>
                <td>
                    <div class="row btn-group" role="group" aria-label="Basic example">
                        <div class="col-6">
                            <a type="button" class="btn btn-secondary" href="{{ URL::to('devices/' . $device->id . '/edit') }}" role="button">Edit</a>
                        </div>
                        <div class="col-6">
                            <form class="delete" action="{{ route('devices.destroy', $device->id) }}" method="POST">
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
