@extends('layouts.main')

@section('content')

<div class="col-8 mt-5">
    <form method="POST" action="{{ url('workers') }}" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">

            <div class="col text-center fs-4">Добавление работника:</div>

            <div class="w-100"></div>

            <div class="col-4 my-4 form-floating ">
                <input type="text" class="form-control" id="Фамилия" name="name1" value="{{ old('name1') }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Фамилия</label>
            </div>

            <div class="col-4 my-4 form-floating ">
                <input type="text" class="form-control" id="Имя" name="name2" value="{{ old('name2') }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Имя</label>
            </div>

            <div class="col-4 my-4 form-floating ">
                <input type="text" class="form-control" id="Отчество" name="name3" value="{{ old('name3') }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Отчество</label>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4">
                <select class="form-select form-floating" name="position" value="{{ old('position') }}" required>
                    <option value="" selected disabled>Должность</option>
                    <option value="{{ $type = 'Электромеханик'}}" @if ( $type == old('type')) ? selected @endif>Электромеханик</option>
                    <option value="{{ $type = 'Старший электромеханик'}}" @if ( $type == old('type')) ? selected @endif>Старший электромеханик</option>
                    <option value="{{ $type = 'Начальник РРУ'}}" @if ( $type == old('type')) ? selected @endif>Начальник РРУ</option>
                </select>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4">
                <label for="signature">Подпись</label>
                <input type="file" class="form-control" id="signature" name="signature" accept=".png">
            </div>

            <div class="w-100"></div>

            <button type="submit" class="col-4 btn btn-primary">Добавить</button>
        </div>
    </form>
</div>

@endsection
