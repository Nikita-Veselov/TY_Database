@extends('layouts.main')

@section('content')

@foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{ $message }}
     </div>
@endforeach

<form method="POST" action="{{ url('controlledPoints') }}">
    @csrf
    <div class="row mb-3">
        <label for="Код" class="col-sm-2 col-form-label">Код</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Код" name="code" value="{{ old('code') }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Тип" class="col-sm-2 col-form-label">Тип</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Тип" name="type" value="{{ old('type') }}">
        </div>
    </div>

    <div class="row mb-3">
      <label for="Код" class="col-sm-2 col-form-label">Название</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Код" name="name" value="{{ old('name') }}">
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Создать</button>
  </form>

@endsection
