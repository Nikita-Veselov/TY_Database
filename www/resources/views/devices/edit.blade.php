@extends('layouts.main')

@section('content')

<form method="POST" action="{{ route('devices.update', ['device' => $device->id]) }}">
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <label for="Код" class="col-sm-2 col-form-label">Код</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Код" name="code" value="{{ $device->code }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Название" class="col-sm-2 col-form-label">Название</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Название" name="name" value="{{ $device->name }}">
        </div>
    </div>

    <div class="row mb-3">
      <label for="Тип" class="col-sm-2 col-form-label">Класс точности</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Тип" name="class" value="{{ $device->class }}">
      </div>
    </div>

    <div class="row mb-3">
        <label for="Дата" class="col-sm-2 col-form-label">Дата</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Дата" name="date" value="{{ $device->date }}">
        </div>
      </div>

    <button type="submit" class="btn btn-primary">Создать</button>
  </form>

@endsection
