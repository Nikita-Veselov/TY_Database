@extends('layouts.main')

@section('content')

<div class="col-8 mt-5">
    <form method="POST" action="{{ route('records.update', ['record' => $record->id]) }}">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">

            <div class="col text-center fs-4">Изменение протокола:</div>

            <div class="w-100"></div>

            <div class="col-4 my-4 form-floating ">
                <input type="text" class="form-control" id="Номер" name="number" value="{{ $record->number  }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Номер</label>
            </div>

            <div class="col-4 my-4 form-floating">
                <input type="text" class="form-control" id="Дата" name="date" value="{{ $record->date }}" placeholder="floating label enabler" required>
                <label for="Дата" class="px-4">Дата</label>
            </div>

            <div class="w-100"></div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" id="Тип протокола" name="type" value="{{ $record->type }}" required >
                    <option value="" selected disabled>Тип протокола</option>
                    <option value="{{ $val = "Опробование" }}" @if ($val == $record->type) ? selected @endif>
                        Опробование
                    </option>
                    <option value="{{ $val = "Профконтроль" }}" @if ($val == $record->type) ? selected @endif>
                        Профконтроль
                    </option>
                    <option value="{{ $val = "Профвосстановление" }}" @if ($val == $record->type) ? selected @endif>
                        Профвосстановление
                    </option>
                </select>
            </div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="controlledPoint" required>
                    <option value="" selected disabled>КП</option>
                    @foreach ($controlledPoints as $CP)
                        <option value="{{ $CP->code }}" @if ( $CP->code == $record->controlledPoint) ? selected @endif>
                            {{ $CP->type }} {{ $CP->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="device" required>
                    <option value="" selected disabled>Устройство</option>
                    @foreach ($devices as $device)
                        <option value="{{ $device->name }}" @if ( $device->name == $record->device) ? selected @endif>
                            {{ $device->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-100"></div>

            <div class="col-3 my-4 form-floating">
                <input type="text" class="form-control"  id="Напряжение ТС" name="UTC" value="{{ $record->UTC }}" placeholder="floating label enabler" required>
                <label for="Напряжение ТС" class="px-4">Напряжение ТС</label>
            </div>

            <div class="col-3 my-4 form-floating">
                <input type="text" class="form-control form-control-sm" id="Напряжение ТУ" name="UTY" value="{{ $record->UTY }}" placeholder="floating label enabler" required>
                <label for="Напряжение ТУ" class="px-4">Напряжение ТУ</label>
            </div>

            <div class="col-3 my-4 form-floating">
                <input type="text" class="form-control form-control-sm" id="Напряжение питания" name="UTP" value="{{ $record->UTP }}" placeholder="floating label enabler" required>
                <label for="Напряжение питания" class="px-4">Напряжение питания</label>
            </div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="worker1" required>
                    <option value="" selected disabled>Работник 1</option>
                    @foreach ($workers as $worker)
                        <option value="{{ $worker->BIO }}" @if ( $worker->BIO == $record->worker1) ? selected @endif>
                            {{ $worker->BIO }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="worker2" required>
                    <option value="" selected disabled>Работник 2</option>
                    <option >Нет</option>
                    @foreach ($workers as $worker)
                        <option value="{{ $worker->BIO }}" @if ($worker->BIO == $record->worker2)) ? selected @endif>
                            {{ $worker->BIO }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="worker3" required>
                    <option value="" selected disabled>Начальник РРУ</option>
                    <option >Нет</option>
                    @foreach ($workers as $worker)
                        <option value="{{ $worker->BIO }}" @if ($worker->BIO == $record->worker3)) ? selected @endif>
                            {{ $worker->BIO }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="worker4" required>
                    <option value="" selected disabled>Старший механик</option>
                    <option >Нет</option>
                    @foreach ($workers as $worker)
                        <option value="{{ $worker->BIO }}" @if ($worker->BIO == $record->worker4)) ? selected @endif>
                            {{ $worker->BIO }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-8 my-4 form-floating">
                <textarea type="text" class="form-control" id="Заключение" name="conclusion" style="height: 100px" placeholder="floating label enabler" required>{{ $record->conclusion }}</textarea>
                <label for="Заключение" class="px-4">Заключение</label>
            </div>

            <div class="w-100"></div>
            <button type="submit" class="col-4 btn btn-primary">Изменить</button>
        </div>
    </form>
</div>
@endsection
