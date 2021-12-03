@extends('layouts.main')

@section('content')

<div class="col-8 mt-5">
    <form method="POST" action="{{ route('devices.update', ['device' => $device->id]) }}">
        @csrf
        @method('PUT')
        <div class="row justify-content-center">

            <div class="col text-center fs-4">Изменение устройства:</div>

            <div class="w-100"></div>

            <div class="col-6 my-4 form-floating ">
                <input type="text" class="form-control" id="Код" name="code" value="{{ $device->code }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Код</label>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4 form-floating">
                <input type="text" class="form-control"  id="Название" name="name" value="{{ $device->name }}" placeholder="floating label enabler" required>
                <label for="Напряжение ТС" class="px-4">Название</label>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4 form-floating ">
                <input type="text" class="form-control" id="Класс точности" name="class" value="{{ $device->class }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Класс точности</label>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4 form-floating ">
                <input type="text" class="form-control" id="Дата" name="date" value="{{ $device->date }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Дата</label>
            </div>

            <div class="w-100"></div>

            <button type="submit" class="col-4 btn btn-primary">Изменить</button>
        </div>
    </form>
</div>
@endsection
