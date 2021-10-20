@extends('layouts.main')

@section('content')

<form method="POST" action="{{ url('records') }}">
    @csrf
    <div class="row mb-3">
        <label for="Номер" class="col-sm-2 col-form-label">Номер</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Номер" name="number" value="{{ old('number') }}">
        </div>
    </div>

    <select class="form-select form-select-sm" id="Тип протокола" name="type">
        <option value="" selected disabled>Тип протокола</option>
        <option value="{{ $val = "Опробование" }}" @if ($val == old('type')) ? selected @endif>
            Опробование
        </option>
        <option value="{{ $val = "Профконтроль" }}" @if ($val == old('type')) ? selected @endif>
            Профконтроль
        </option>
        <option value="{{ $val = "Профвосстановление" }}" @if ($val == old('type')) ? selected @endif>
            Профвосстановление
        </option>
    </select>

    <div class="row mb-3">
      <label for="Дата" class="col-sm-2 col-form-label">Дата</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Дата" name="date" value="{{ old('date') }}">
      </div>
    </div>

    <select class="form-select form-select-sm" name="controlledPoint">
        <option value="" selected disabled>КП</option>
        @foreach ($controlledPoints as $CP)
            <option value="{{ $CP->code }}" @if ( $CP->code == old('controlledPoint')) ? selected @endif>
                {{ $CP->type }} {{ $CP->name }}
            </option>
        @endforeach
    </select>

    <select class="form-select form-select-sm" name="device">
        <option value="" selected disabled>Устройство</option>
        @foreach ($devices as $device)
            <option value="{{ $device->name }}" @if ( $device->name == old('device')) ? selected @endif>
                {{ $device->name }}
            </option>
        @endforeach
    </select>

    <div class="row mb-3">
        <label for="Напряжение ТС" class="col-sm-2 col-form-label">Напряжение ТС</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Напряжение ТС" name="UTY" value="{{ old('UTY') }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Напряжение ТУ" class="col-sm-2 col-form-label">Напряжение ТУ</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Напряжение ТУ" name="UTC" value="{{ old('UTC') }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Напряжение питания" class="col-sm-2 col-form-label">Напряжение питания</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Напряжение питания" name="UTP" value="{{ old('UTP') }}">
        </div>
    </div>

    <select class="form-select form-select-sm" name="worker1">
        <option selected disabled>Работник 1</option>
        @foreach ($workers as $worker)
            <option value="{{ $worker->BIO }}" @if ( $worker->BIO == old('worker1')) ? selected @endif>
                {{ $worker->BIO }}
            </option>
        @endforeach
    </select>

    <select class="form-select form-select-sm" name="worker2">
        <option selected disabled>Работник 2</option>
        <option >Нет</option>
        @foreach ($workers as $worker)
            <option value="{{ $worker->BIO }}" @if ($worker->BIO == old('worker2')) ? selected @endif>
                {{ $worker->BIO }}
            </option>
        @endforeach
    </select>

    <div class="row mb-3">
        <label for="Дата" class="col-sm-2 col-form-label">Заключение</label>
        <div class="col-sm-10 ">
            <textarea type="text" class="form-control" id="Заключение" name="conclusion">По результатам технического обслуживания устройства ТУ и средства постоянного технического диагностирования, признано годным к дальнейшей эксплуатации и может быть введено в работу.</textarea>
        </div>
      </div>

    <button type="submit" class="btn btn-primary">Создать</button>
</form>

@endsection
