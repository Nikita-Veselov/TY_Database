@extends('layouts.main')

@section('content')
    <div class="tw-container tw-mx-auto vh-100">
        <div class="header row">
            <div class="tw-text-center tw-text-3xl">Title</div>
            <div class="col tw-text-center tw-text-sm">Subtitle</div>
        </div>

        <div class="row">
            <div class="col-6 tw-mx-auto">
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

        <div class="footer row">
            <div class="col"></div>
        </div>
    </div>
@endsection
