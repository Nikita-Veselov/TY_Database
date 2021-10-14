<div>
    <div class="header row text-start">
        <div class="fs-3">TY</div>
        <div class="fs-6">База протоколов</div>

        <div class="row justify-content-center" style="height: 4rem;">
            <div class="">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger text-center">{{ $error }}</div>
                    @endforeach
                @endif

                @if (Session::has('success'))
                    <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
                @endif
            </div>
        </div>



        <div class="text-start">
            <a class="col-2 mx-auto btn btn-secondary" href="/" role="button">Назад</a>
        </div>


    </div>
</div>
