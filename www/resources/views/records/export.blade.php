<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Database</title>

        {{-- Mix CSS and JS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <style>
        .page-break {
          page-break-before: always;
        }
        .title {
            font-size: 1.40em;
        }
    </style>
</head>
<body>
    <div class="container d-flex flex-column mx-auto vh-100">
        <div class="main flex-grow-1">
            <div class="row justify-content-center">

            @php
                $arr1 = explode(' ', $worker1->BIO);
                $worker1->name1 = $arr1[0];
                $worker1->name2 = $arr1[1];
                $worker1->name3 = $arr1[2];
            @endphp
            @if ($worker2 != null)
                @php
                    $arr2 = explode(' ', $worker2->BIO);
                    $worker2->name1 = $arr2[0];
                    $worker2->name2 = $arr2[1];
                    $worker2->name3 = $arr2[2];
                @endphp
            @endif

            <div class="container">
                    {{-- Title --}}
                <div class="title col text-center fs-2 fw-bold">
                    Протокол технического обслуживания стойки телемеханики КП-М (ПС) в объеме
                    @switch($record->type)
                    @case("Профвосстановление")
                        профвосстановления
                        @break
                    @case("Профконтроль")
                        профконтроля
                        @break
                    @default
                        опробования
                    @endswitch
                    на
                </div>
                    {{-- Station --}}
                <div class="col title text-center fs-4 fw-bold mb-2">
                    ст. {{ $CP->name }}
                </div>
                    {{-- Record number and date --}}
                <div class="col text-center">№{{ $record->number }}</div>
                <div class="col text-center mb-4">
                    {{ $record->date }}
                </div>
                    {{-- Modem data --}}
                <div class="col-6 mb-4">
                    <div class="row text-start">
                        <div class="col-12 fw-bold fst-italic text-decoration-underline">для Модема-УКП:</div>
                        <div class="col-8">Номер КП: {{ $record->controlledPoint }}</div>
                        <div class="col">Номер контроллера: {{ $record->controlledPoint }}</div>
                        <div class="col">Количество попыток автоопределения: 1</div>

                        <div class="col-12 text-decoration-underline">Телеуправление</div>
                        <div class="col">Частота ТУ: 1300 Гц</div>
                        <div class="col">Аттеньюация сигнала: 0 дБ</div>
                        <div class="col text-decoration-underline">Телесигнализация</div>
                        <div class="col">Частота ТС: 1300 Гц</div>
                        <div class="col-12">Уровень сигнала при нагрузке 600 Ом установлен - 13 дБ</div>
                    </div>
                </div>

                    {{-- Evalueted data --}}
                <table class="table table-bordered align-middle text-center mb-5">
                    <thead>
                      <tr class="align-middle">
                        <th scope="col">Проверяемый показатель (характеристика)</th>
                        <th scope="col">Еденица измерения</th>
                        <th scope="col">Значение</th>
                        <th scope="col">Наименование средства измерения или оборудования</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-start col-5">
                            1. Полная потребляемая мощность от источника напряжения переменного тока, не более:
                            <ol>
                                <li>При выключенном подогреве:</li>
                                <li>При включенном подогреве:</li>
                            </ol>
                        </td>
                        <td class="col-1">В*А</td>
                        <td class="col-1">
                            <div class="col">45</div>
                            <div class="col">90</div>
                        </td>
                        <td class="text-start col-5">
                            <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                            <div class="col">Класс точноcти {{ $device->class }}</div>
                            <div class="col">Дата след. калибровки: {{ $device->date }}</div>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-start">
                            <div class="col">2. Напряжение питания цепей ТС</div>
                            <div class="col">Норма: 110 В</div>
                        </td>
                        <td>В</td>
                        <td>{{ $record->UTC }}</td>
                        <td class="text-start">
                            <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                            <div class="col">Класс точноcти {{ $device->class }}</div>
                            <div class="col">Дата след. калибровки {{ $device->date }}</div>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-start">
                            <div class="col">3. Напряжение питания цепей ТУ</div>
                            <div class="col">Норма: 26.5 В</div>
                        </td>
                        <td>В</td>
                        <td>{{ $record->UTY }}</td>
                        <td class="text-start">
                            <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                            <div class="col">Класс точноcти {{ $device->class }}</div>
                            <div class="col">Дата след. калибровки {{ $device->date }}</div>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-start">4. Уровень передаваемого сигнала на линейном входе шкафа при электрическом сопротивлении нагрузки (1800 +- 18 Ом), не более</td>
                        <td>дБ</td>
                        <td>24</td>
                        <td class="text-start">
                            <ol>
                                <li>Персональная ЭВМ с платой Sound maker 3DX2 (Full duplex) и программами SpectraLab и МОДЕМ-СЕРВИС</li>
                                <li>Штекер стерео 3,5 мм (тип кабеля - три провода в экране)</li>
                            </ol>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-start">
                            <div class="col">5. Температура срабатывания устройства подогрева шкафа КП-М (ПС):</div>
                            <ol>
                                <li>Включение, не выше (норма: 5 C0)</li>
                                <li>Отключеник, не ниже (норма: 15 C0)</li>
                            </ol>
                        </td>
                        <td>С0</td>
                        <td>
                            <div class="col">5</div>
                            <div class="col">15</div>
                        </td>
                        <td class="text-start">
                            <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                            <div class="col">Класс точноcти {{ $device->class }}</div>
                            <div class="col">Дата след. калибровки {{ $device->date }}</div>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-start">
                            <div class="col">6. Напряжение питания шкафа КП-М (ПС). Норма</div>
                            <div class="col">Норма: 180-250 В</div>
                        </td>
                        <td>В</td>
                        <td>{{ $record->UTP }}</td>
                        <td class="text-start">
                            <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                            <div class="col">Класс точноcти {{ $device->class }}</div>
                            <div class="col">Дата след. калибровки {{ $device->date }}</div>
                        </td>
                      </tr>
                    </tbody>
                </table>

                <div class="page-break"></div>

                    {{-- Controller file --}}
                <div class="col text-start">
                    <div class="col">Для контроллера МКД</div>
                    <div class="col">Имя файла прошивки - "ст. {{ $CP->name }}.mkd"</div>
                </div>
                    {{-- TC table --}}
                <table class="table table-bordered table-sm mb-5">
                    <thead class="text-center align-middle">
                      <tr>
                        <th scope="col">Название сигнала</th>
                        <th scope="col">Клемма КП-М (ПС)</th>
                        <th scope="col">№ ТС</th>
                        <th scope="col">Инверсия в настройке</th>
                        <th scope="col">Оперативное название сигнала</th>
                        <th scope="col">Соответствие сигнала с ДП</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($TC as $tc)
                        <tr class="text-center">
                            <td class="text-start col-3">{{ $tc->name }}</td>
                            <td class="col-1">{{ $tc->klemm }}</td>
                            <td class="col-1">{{ $tc->number }}</td>
                            <td class="col-1">{{ $tc->invert }}</td>
                            <td class="col-3">{{ $tc->oper }}</td>
                            <td class="col-3">{{ $tc->DP }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    {{-- TY table --}}
                <table class="table table-bordered table-sm table-fixed">
                    <thead>
                      <tr class="text-center align-middle">
                        <th scope="col">Название сигнала</th>
                        <th scope="col">Клемма КП-М (ПС)</th>
                        <th scope="col">№ ТУ</th>
                        <th scope="col">Оперативное название сигнала</th>
                        <th scope="col">Соответствие сигнала с ДП</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($TY as $ty)
                        <tr class="text-center">
                            <td class="text-start col-3">{{ $ty->name }}</td>
                            <td class="col-2">{{ $ty->klemm }}</td>
                            <td class="col-1">{{ $ty->number }}</td>
                            <td class="col-3">{{ $ty->oper }}</td>
                            <td class="col-3">{{ $ty->DP }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    {{-- Conclusion --}}
                <div class="row mb-4">
                    <div class="col fw-bold">Заключение:</div>
                    <div class="col">{{ $record->conclusion }}</div>
                </div>
                    {{-- Workers --}}
                <div class="row mb-3">
                    <div class="col-12 mb-3 fw-bolder">Проверку проводил:</div>
                    <div class="col-12 mb-3"> {{ $worker1->position }} {{ $worker1->name1 }} {{ mb_substr($worker1->name2, 0, 1) }}. {{ mb_substr($worker1->name3, 0, 1); }}.</div>
                    @if ($worker2 != null)
                        <div class="col-12 mb-3"> {{ $worker2->position }} {{  $worker2->name1 }} {{ mb_substr($worker2->name2, 0, 1) }}. {{ mb_substr($worker2->name3, 0, 1) }}.</div>
                    @endif
                </div>
                <div class="row mb-3">
                    <div class="col-12 mb-3 fw-bolder">Протокол проверил:</div>
                    <div class="col-12 mb-3">Начальник РРУ Акудович Е.В.</div>
                </div>
            </div>

            </div>
        </div>
    </div>
</body>
</html>
