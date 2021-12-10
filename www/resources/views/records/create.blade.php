@extends('layouts.main')

@section('content')

<div class="col-8 mt-5">
    <form method="POST" action="{{ url('records') }}" class="">
        @csrf
        <div class="row justify-content-center">

            <div class="col text-center fs-4">Создание протокола:</div>

            <div class="w-100"></div>

            <div class="col-4 my-4 form-floating ">
                <input type="text" class="form-control" id="Номер" name="number" value="{{ old('number') }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Номер</label>
            </div>

            <div class="col-4 my-4 form-floating">
                <input type="text" class="form-control" id="Дата" name="date" value="{{ old('date') }}" placeholder="floating label enabler" required>
                <label for="Дата" class="px-4">Дата</label>
            </div>

            <div class="w-100"></div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" id="Тип протокола" name="type" required>
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
            </div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="controlledPoint" required>
                    <option value="" selected disabled>КП</option>
                    @foreach ($controlledPoints as $CP)
                        <option value="{{ $CP->code }}" @if ( $CP->code == old('controlledPoint')) ? selected @endif>
                            {{ $CP->type }} {{ $CP->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="device" required>
                    <option value="" selected disabled>Устройство</option>
                    @foreach ($devices as $device)
                        <option value="{{ $device->name }}" @if ( $device->name == old('device')) ? selected @endif>
                            {{ $device->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-100"></div>

            <div class="col-3 my-4 form-floating">
                <input type="text" class="form-control"  id="Напряжение ТС" name="UTC" value="{{ old('UTC') }}" placeholder="floating label enabler" required>
                <label for="Напряжение ТС" class="px-4">Напряжение ТС</label>
            </div>

            <div class="col-3 my-4 form-floating">
                <input type="text" class="form-control form-control-sm" id="Напряжение ТУ" name="UTY" value="{{ old('UTY') }}" placeholder="floating label enabler" required>
                <label for="Напряжение ТУ" class="px-4">Напряжение ТУ</label>
            </div>

            <div class="col-3 my-4 form-floating">
                <input type="text" class="form-control form-control-sm" id="Напряжение питания" name="UTP" value="{{ old('UTP') }}" placeholder="floating label enabler" required>
                <label for="Напряжение питания" class="px-4">Напряжение питания</label>
            </div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="worker1" required>
                    <option value="" selected disabled>Работник 1</option>
                    @foreach ($workers as $worker)
                        <option value="{{ $worker->BIO }}" @if ( $worker->BIO == old('worker1')) ? selected @endif>
                            {{ $worker->BIO }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="worker2" required>
                    <option value="" selected disabled>Работник 2</option>
                    <option @if ($worker->BIO == old('worker4')) ? selected @endif>Нет</option>
                    @foreach ($workers as $worker)
                        <option value="{{ $worker->BIO }}" @if ($worker->BIO == old('worker2')) ? selected @endif>
                            {{ $worker->BIO }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-100"></div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="worker3" required>
                    <option value="" selected disabled>Начальник РРУ</option>
                    @foreach ($workers as $worker)
                        <option value="{{ $worker->BIO }}" @if ($worker->BIO == old('worker3')) ? selected @endif>
                            {{ $worker->BIO }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-4 my-4">
                <select class="form-select form-floating" name="worker4" required>
                    <option value="" selected disabled>Старший механик</option>
                    @foreach ($workers as $worker)
                        <option value="{{ $worker->BIO }}" @if ($worker->BIO == old('worker4')) ? selected @endif>
                            {{ $worker->BIO }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-100"></div>

            <div class="col-8 my-4 form-floating">
                <textarea type="text" class="form-control" id="Заключение" name="conclusion" style="height: 100px" placeholder="floating label enabler" required>По результатам технического обслуживания устройства ТУ и средства постоянного технического диагностирования,признано годным к дальнейшей эксплуатации и может быть введено в работу.</textarea>
                <label for="Заключение" class="px-4">Заключение</label>
            </div>

            <div class="w-100"></div>
            <button type="submit" class="col-4 btn btn-primary">Создать</button>
        </div>
    </form>
</div>

@endsection
