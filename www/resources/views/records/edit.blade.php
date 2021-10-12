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

    <select class="form-select form-select-sm" id="Тип протокола" name="type" value="{{ $record->type }}">
        <option value="" disabled>Тип протокола</option>
        <option value="Опробование"
            @if ($record->type == "Опробование")
                selected
            @endif
        >
            Опробование
        </option>
        <option value="Профконтроль"
            @if ($record->type == "Профконтроль")
                selected
            @endif
        >
            Профконтроль
        </option>
        <option value="Профвосстановление"
            @if ($record->type == "Профвосстановление")
                selected
            @endif
        >
            Профвосстановление
        </option>
    </select>

    <div class="row mb-3">
      <label for="Дата" class="col-sm-2 col-form-label">Дата</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Дата" name="date" value="{{ $record->date }}">
      </div>
    </div>

    <select class="form-select form-select-sm" name="controlledPoint" value="{{ $record->controlledPoint }}">
        <option value="" disabled>CP</option>
        @foreach ($controlledPoints as $CP)
            <option value="{{ $CP->name }}"
                @if ($CP->name == $record->controlledPoint)
                    selected
                @endif
            >
                {{ $CP->name }}
            </option>
        @endforeach
    </select>

    <select class="form-select form-select-sm" name="device" value="{{ $record->device }}">
        <option value="" disabled>Devices</option>
        @foreach ($devices as $device)
            <option value="{{ $device->name }}"
                @if ( $device->name == $record->device)
                    selected
                @endif
            >
                {{ $device->name }}
            </option>
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

    <div class="row mb-3">
        <label for="Дата" class="col-sm-2 col-form-label">Заключение</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Заключение" name="conclusion" value="{{ $record->conclusion }}">
        </div>
      </div>

    <select class="form-select form-select-sm" name="worker1" value="{{ $record->worker1 }}">
        <option value="" disabled>Workers</option>
        @foreach ($workers as $worker)
            <option value="{{ $worker->BIO }}"
                @if ( $worker->BIO == $record->worker1)
                    selected
                @endif
            >
                {{ $worker->BIO }}
            </option>
        @endforeach
    </select>

    <select class="form-select form-select-sm" name="worker2" value="{{ $record->worker2 }}">
        <option value="" disabled>Workers</option>
        <option>Нет</option>
        @foreach ($workers as $worker)
            <option value="{{ $worker->BIO }}"
                @if ( $worker->BIO == $record->worker2)
                    selected
                @endif
            >
                {{ $worker->BIO }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary">Создать</button>
  </form>

@endsection
