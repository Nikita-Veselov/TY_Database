@extends('layouts.main')

@section('content')

@foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{ $message }}
     </div>
@endforeach

<form method="POST" action="{{ route('records.update', ['record' => $record->id]) }}">
    @method('PUT')
    @csrf
    <div class="row mb-3">
        <label for="Номер" class="col-sm-2 col-form-label">Номер</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Номер" name="number" value="{{ $record->number }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Тип протокола" class="col-sm-2 col-form-label">Тип протокола</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Тип протокола" name="type" value="{{ $record->type }}">
        </div>
    </div>

    <div class="row mb-3">
      <label for="Дата" class="col-sm-2 col-form-label">Дата</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Дата" name="date" value="{{ $record->date }}">
      </div>
    </div>

    <select class="form-select form-select-sm" name="controlledPoint" value="{{ $record->controlledPoint }}">
        <option value="" selected disabled>CP</option>
        @foreach ($controlledPoints as $CP)
            <option value="{{ $CP->name }}">{{ $CP->name }}</option>
        @endforeach
    </select>

    <select class="form-select form-select-sm" name="device" value="{{ $record->device }}">
        <option value="" selected disabled>Devices</option>
        @foreach ($devices as $device)
            <option value="{{ $device->name }}">{{ $device->name }}</option>
        @endforeach
    </select>

    <div class="row mb-3">
        <label for="Напряжение ТС" class="col-sm-2 col-form-label">Напряжение ТС</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Напряжение ТС" name="UTY" value="{{ $record->UTY }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Напряжение ТУ" class="col-sm-2 col-form-label">Напряжение ТУ</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Напряжение ТУ" name="UTC" value="{{ $record->UTC }}">
        </div>
    </div>

    <select class="form-select form-select-sm" name="worker" value="{{ $record->worker }}">
        <option value="" selected disabled>Workers</option>
        @foreach ($workers as $worker)
            <option value="{{ $worker->BIO }}">{{ $worker->BIO }}</option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary">Создать</button>
  </form>

@endsection
