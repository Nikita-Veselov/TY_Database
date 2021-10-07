@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-6 mx-auto">
            <form action="">
                <label for="1" class="form-label"></label>
                <div class="row">
                    <select class="form-select" aria-label="Default select example" name="1">
                        <option selected>Choose..</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <label for="2" class="form-label">Email address</label>
                <div class="row">
                    <select class="form-select" aria-label="Default select example" name="2">
                        <option selected>Choose..</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <label for="3" class="form-label">Email address</label>
                <div class="row">
                    <select class="form-select" aria-label="Default select example" name="3">
                        <option selected>Choose..</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">
        <a class="col-4 btn btn-secondary" href="/" role="button">Назад</a>
        <a class="col-4 btn btn-primary" href="#" role="button">Вперед</a>
    </div>

@endsection
