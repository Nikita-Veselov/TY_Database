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
                    <div class="col text-center">
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col">№{{ $record->number }}</div>

                        </div>
                    </div>
                    <div class="col text-center mb-4">{{ $record->date }}</div>

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
                    @switch($record->type)
                        @case("Профвосстановление")
                            <table class="table table-bordered align-middle text-center mb-3">
                                <thead>
                                <tr class="align-middle">
                                    <th scope="col" class="col-4">Проверяемый показатель (характеристика)</th>
                                    <th scope="col" class="col-2">Норма</th>
                                    <th scope="col" class="col-2">Результат</th>
                                    <th scope="col" class="col-4">Наименование средства измерения или оборудования</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-start">
                                            Контроль исправности встроенного блока питания в контрольных точках
                                        </td>
                                        <td>
                                            <div class="col">110 В</div>
                                            <div class="col">26,5 В</div>
                                            <div class="col">220 В</div>
                                        </td>
                                        <td>
                                            <div class="col">{{ $record->UTC }} В</div>
                                            <div class="col">{{ $record->UTY }} В</div>
                                            <div class="col">{{ $record->UTP }} В</div>
                                        </td>
                                        <td class="text-start">
                                            <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                                            <div class="col">Класс точноcти {{ $device->class }}</div>
                                            <div class="col">Дата след. калибровки: {{ $device->date }}</div>
                                        </td>
                                    </tr>
                                <tr>
                                    <td class="text-start">
                                        Контроль работоспособности схемы перехода с основного питания на резервное и обратно
                                    </td>
                                    <td>В соответствие со схемой</td>
                                    <td>Соответствует</td>
                                    <td> - </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                    Проверка уровней сигналов в каналах связи
                                    </td>
                                    <td>-20 дБ .. +5 дБ</td>
                                    <td>-13 дБ</td>
                                    <td class="text-start">
                                        <div class="col" >Персональная ЭВМ с платой Sound maker 3DX2 (Full duplex) и программами SpectraLab и МОДЕМ-СЕРВИС</div>
                                        <div class="col" >Штекер стерео 3,5 мм (тип кабеля - три провода в экране)</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                        Контроль правильности программного задания конфигурации устройства в целом и отдельных его частей
                                    </td>
                                    <td>В соответствие с заданной программой</td>
                                    <td>Соответствует</td>
                                    <td class=""> - </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                        Контроль правильности отображения значений контролируемых физических величин
                                    </td>
                                    <td>В соответствие с заданной программой</td>
                                    <td>Соответствует</td>
                                    <td class="text-start">
                                        <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                                        <div class="col">Класс точноcти {{ $device->class }}</div>
                                        <div class="col">Дата след. калибровки: {{ $device->date }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                        Контроль правильности исполнения функций телесигнализации, телеизмерений, регистрации сигналов, определения места повреждения
                                    </td>
                                    <td>В соответствие с заданной программой</td>
                                    <td>Соответствует</td>
                                    <td> - </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                        Контроль работоспособности встроенных функций самодиагностики и тестового контроля
                                    </td>
                                    <td> - </td>
                                    <td>Норма</td>
                                    <td> - </td>
                                </tr>
                                </tbody>
                            </table>
                        @break
                            @case("Профконтроль")
                            <table class="table table-bordered align-middle text-center mb-3">
                                <thead>
                                <tr class="align-middle">
                                    <th scope="col" class="col-4">Проверяемый показатель (характеристика)</th>
                                    <th scope="col" class="col-2">Норма</th>
                                    <th scope="col" class="col-2">Результат</th>
                                    <th scope="col" class="col-4">Наименование средства измерения или оборудования</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-start">
                                            Контроль исправности встроенного блока питания в контрольных точках
                                        </td>
                                        <td>
                                            <div class="col">110 В</div>
                                            <div class="col">26,5 В</div>
                                            <div class="col">220 В</div>
                                        </td>
                                        <td>
                                            <div class="col">{{ $record->UTC }} В</div>
                                            <div class="col">{{ $record->UTY }} В</div>
                                            <div class="col">{{ $record->UTP }} В</div>
                                        </td>
                                        <td class="text-start">
                                            <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                                            <div class="col">Класс точноcти {{ $device->class }}</div>
                                            <div class="col">Дата след. калибровки: {{ $device->date }}</div>
                                        </td>
                                    </tr>
                                <tr>
                                    <td class="text-start">
                                        Контроль работоспособности схемы перехода с основного питания на резервное и обратно
                                    </td>
                                    <td>В соответствие со схемой</td>
                                    <td>Соответствует</td>
                                    <td> - </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                    Проверка уровней сигналов в каналах связи
                                    </td>
                                    <td>-20 дБ .. +5 дБ</td>
                                    <td>-13 дБ</td>
                                    <td class="text-start">
                                        <div class="col" >Персональная ЭВМ с платой Sound maker 3DX2 (Full duplex) и программами SpectraLab и МОДЕМ-СЕРВИС</div>
                                        <div class="col" >Штекер стерео 3,5 мм (тип кабеля - три провода в экране)</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                        Контроль правильности отображения значений контролируемых физических величин
                                    </td>
                                    <td>В соответствие с заданной программой</td>
                                    <td>Соответствует</td>
                                    <td class="text-start">
                                        <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                                        <div class="col">Класс точноcти {{ $device->class }}</div>
                                        <div class="col">Дата след. калибровки: {{ $device->date }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                        Контроль правильности исполнения функций телесигнализации, телеизмерений, регистрации сигналов, определения места повреждения
                                    </td>
                                    <td>В соответствие с заданной программой</td>
                                    <td>Соответствует</td>
                                    <td> - </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                        Контроль работоспособности встроенных функций самодиагностики и тестового контроля
                                    </td>
                                    <td>В соответствие с заданной программой</td>
                                    <td>Соответствует</td>
                                    <td> - </td>
                                </tr>
                                </tbody>
                            </table>
                        @break
                            @default
                            <table class="table table-bordered align-middle text-center mb-3">
                                <thead>
                                <tr class="align-middle">
                                    <th scope="col" class="col-4">Проверяемый показатель (характеристика)</th>
                                    <th scope="col" class="col-2">Норма</th>
                                    <th scope="col" class="col-2">Результат</th>
                                    <th scope="col" class="col-4">Наименование средства измерения или оборудования</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-start">
                                        Внешний осмотр
                                    </td>
                                    <td> - </td>
                                    <td>Норма</td>
                                    <td> - </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                        Проверка действия устройства на комутационные аппараты с помощью штатной функции самоконтроля
                                    </td>
                                    <td>В соответствие с заданной программой</td>
                                    <td>Соответствует</td>
                                    <td> - </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                        Контроль взаимодействия проверяемого устройства с другими устройствами и действия устройства
                                        на коммутационные аппараты
                                    </td>
                                    <td>В соответствие с заданной программой</td>
                                    <td>Соответствует</td>
                                    <td> - </td>
                                </tr>
                                <tr>
                                    <td class="text-start">
                                        Контроль исправности встроенного блока питания в контрольных точках
                                    </td>
                                    <td>
                                        <div class="col">110 В</div>
                                        <div class="col">26,5 В</div>
                                        <div class="col">220 В</div>
                                    </td>
                                    <td>
                                        <div class="col">{{ $record->UTC }} В</div>
                                        <div class="col">{{ $record->UTY }} В</div>
                                        <div class="col">{{ $record->UTP }} В</div>
                                    </td>
                                    <td class="text-start">
                                        <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                                        <div class="col">Класс точноcти {{ $device->class }}</div>
                                        <div class="col">Дата след. калибровки: {{ $device->date }}</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                    @endswitch

                        {{-- Controller file --}}
                    <div class="col text-start">
                        <div class="col">Для контроллера МКД</div>
                        <div class="col">Имя файла прошивки - "ст. {{ $CP->name }}.mkd"</div>
                    </div>

                        {{-- New page --}}
                    <div class="page-break"></div>

                        {{-- TC table --}}
                    <div class="col text-start mt-2">Таблица ТС</div>
                    <table class="table table-bordered table-sm mb-4">
                        <thead class="text-center align-middle">
                        <tr>
                            <th scope="col" class="col-3">Название сигнала</th>
                            @if ($CP->type != "ТП")
                                <th scope="col" class="col-1">Клемма КП-М (ПС)</th>
                            @endif
                            <th scope="col" class="col-2">
                                @if ($CP->type != "ТП")
                                    № ТУ
                                @else
                                    № AL32
                                @endif
                            </th>
                            @if ($CP->type != "ТП")
                            <th scope="col" class="col-1">Инверсия в настройке</th>
                            @endif
                            <th scope="col" class="col-3">Оперативное название сигнала</th>
                            <th scope="col" class="col-2">Соответствие сигнала с ДП</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($TC as $tc)
                            <tr class="text-center">
                                <td class="text-start">{{ $tc->name }}</td>
                                @if ($CP->type != "ТП")
                                    <td>{{ $tc->klemm }}</td>
                                @endif
                                <td>{{ $tc->number }}</td>
                                @if ($CP->type != "ТП")
                                <td>{{ $tc->invert }}</td>
                                @endif
                                <td>{{ $tc->oper }}</td>
                                <td>{{ $tc->DP }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{-- TY table --}}

                    <div class="col text-start">Таблица ТУ</div>
                    <table class="table table-bordered table-sm table-fixed">
                        <thead>
                        <tr class="text-center align-middle">
                            <th scope="col" class="col-3">Название сигнала</th>
                            @if ($CP->type != "ТП")
                            <th scope="col" class="col-2">Клемма КП-М (ПС)</th>
                            @endif
                            <th scope="col" class="col-2">
                                @if ($CP->type != "ТП")
                                    № ТУ
                                @else
                                    № AL32
                                @endif
                            </th>
                            <th scope="col" class="col-3">Оперативное название сигнала</th>
                            <th scope="col" class="col-2">Соответствие сигнала с ДП</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($TY as $ty)
                            <tr class="text-center">
                                <td class="text-start">{{ $ty->name }}</td>
                                @if ($CP->type != "ТП")
                                <td>{{ $ty->klemm }}</td>
                                @endif
                                <td>{{ $ty->number }}</td>
                                <td>{{ $ty->oper }}</td>
                                <td>{{ $ty->DP }}</td>
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
                    <div class="row mt-3">
                        <div class="col-12 mt-3 fw-bolder">Проверку проводил:</div>
                        <div class="row position-relative">
                            <div class="col-4 mt-3">
                                {{ $worker1->position }}
                                {{ $worker1->name1 }}
                                {{ mb_substr($worker1->name2, 0, 1) }}.
                                {{ mb_substr($worker1->name3, 0, 1); }}.
                            </div>

                        </div>
                        @if ($worker2 != null)
                        <div class="row position-relative">
                            <div class="col-4 mt-3">
                                {{ $worker2->position }}
                                {{ $worker2->name1 }}
                                {{ mb_substr($worker2->name2, 0, 1) }}.
                                {{ mb_substr($worker2->name3, 0, 1); }}.
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row position-relative">
                        <div class="col-12 mt-3 fw-bolder">Протокол проверил:</div>
                        <div class="col-4 mt-3">
                            Начальник РРУ Акудович Е.В.
                        </div>

                        <div class="wh-100"></div>
                        <div class="col-4 mt-3">
                            ст.эл.мех. Соколов Е.И.
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
