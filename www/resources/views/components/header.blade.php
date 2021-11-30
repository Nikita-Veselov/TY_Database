<div class="header row text-start fixed-top bg-light shadow rounded">
    <div class="col-4 px-5 align-self-center">
        @if (!Request::is('/'))
                <a class="col-4 btn btn-outline-warning" href="/" role="button">На главную</a>

            @if (Request::is('records/*'))
                <a class="col-2 btn btn-outline-success" href="{{ route('records.index') }}" role="button">Назад</a>
            @endif

            @if (Request::is('workers/*'))
                <a class="col-2 btn btn-outline-success" href="{{ route('workers.index') }}" role="button">Назад</a>
            @endif

            @if (Request::is('devices/*'))
                <a class="col-2 btn btn-outline-success" href="{{ route('devices.index') }}" role="button">Назад</a>
            @endif

            @if (Request::is('controlledPoints/*'))
                <a class="col-2 btn btn-outline-success" href="{{ route('controlledPoints.index') }}" role="button">Назад</a>
            @endif

        @endif
    </div>

    <div class="col-4 text-center px-5 align-self-center">
        <div class="fs-3">Телемеханика</div>
        <div class="fs-6">База данных</div>
    </div>

    <div class="col-4 text-center px-5 align-self-center">
        <a class="col-2 btn btn-outline-secondary" href="{{ route('login') }}" role="button">Вход</a>
        <a class="col-2 btn btn-outline-dark" href="JavaScript:window.close()" role="button">Выход</a>
    </div>

    <div class="px-5 align-self-center">
        <div class="row justify-content-center fixed-top">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger text-center col-3">{{ $error }}</div>
                @endforeach
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
            @endif
        </div>
    </div>


</div>

