@extends('layouts.main')

@section('content')


<div class="container">
        {{-- Title --}}
    <div class="col text-center">
        Протокол технического обсложивания стойки телемеханики КП-М (ПС) в объеме
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
    </div>
        {{-- Station --}}
    <div class="col text-center">
        ст. {{ $record->controlledPoint }}
    </div>
        {{-- Record number and date --}}
    <div class="col text-center">№{{ $record->number }}</div>
    <div class="col text-center">
        {{ $record->date }}
    </div>
        {{-- Modem data --}}
    <div class="col-6">
        <div class="row text-start">
            <div class="col-12">для Модема-УКП</div>
            <div class="col-8">Номер КП</div>
            <div class="col-4">18</div>
            <div class="col-8">Номер контроллера</div>
            <div class="col-4">18</div>
            <div class="col-8">Количество попыток автоопределения</div>
            <div class="col-4">1</div>

            <div class="col-12">Телеуправление</div>
            <div class="col-8">Частота ТУ</div>
            <div class="col-4">1300 Гц</div>
            <div class="col-8">Аттеньюация сигнала</div>
            <div class="col-4">0 дБ</div>
            <div class="col-12">Телесигнализация</div>
            <div class="col-8">Частота ТС</div>
            <div class="col-4">1300 Гц</div>
            <div class="col-12">Уровень сигнала при нагрузке 600 Ом установлен - 13 дБ</div>
        </div>
    </div>
        {{-- Evalueted data --}}
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Проверяемый показатель (характеристика)</th>
            <th scope="col">Еденица измерения</th>
            <th scope="col">Значение</th>
            <th scope="col">Наименование средства измерения или оборудования</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
                1. Полная потребляемая мощность от источника напряжения переменного тока, не более:
                <ol>
                    <li>При выключенном подогреве:</li>
                    <li>При включенном подогреве:</li>
                </ol>
            </td>
            <td>В*А</td>
            <td>
                <div class="col">45</div>
                <div class="col">90</div>
            </td>
            <td>
                <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                <div class="col">Класс точноcти {{ $device->class }}</div>
                <div class="col">Дата след. калибровки: {{ $device->date }}</div>
            </td>
          </tr>
          <tr>
            <td>
                <div class="col">2. Напряжение питания цепей ТС</div>
                <div class="col">Норма: 110 В</div>
            </td>
            <td>В</td>
            <td>{{ $record->UTC }}</td>
            <td>
                <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                <div class="col">Класс точноcти {{ $device->class }}</div>
                <div class="col">Дата след. калибровки {{ $device->date }}</div>
            </td>
          </tr>
          <tr>
            <td>
                <div class="col">3. Напряжение питания цепей ТУ</div>
                <div class="col">Норма: 26.5 В</div>
            </td>
            <td>В</td>
            <td>{{ $record->UTY }}</td>
            <td>
                <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                <div class="col">Класс точноcти {{ $device->class }}</div>
                <div class="col">Дата след. калибровки {{ $device->date }}</div>
            </td>
          </tr>
          <tr>
            <td>4. Уровень передаваемого сигнала на линейном входе шкафа при электрическом сопротивлении нагрузки (1800 +- 18 Ом), не более</td>
            <td>дБ</td>
            <td>24</td>
            <td>
                <ol>
                    <li>Персональная ЭВМ с платой Sound maker 3DX2 (Full duplex) и программами SpectraLab и МОДЕМ-СЕРВИС</li>
                    <li>Штекер стерео 3,5 мм (тип кабеля - три провода в экране)</li>
                </ol>
            </td>
          </tr>
          <tr>
            <td>
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
            <td>
                <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                <div class="col">Класс точноcти {{ $device->class }}</div>
                <div class="col">Дата след. калибровки {{ $device->date }}</div>
            </td>
          </tr>
          <tr>
            <td>
                <div class="col">6. Напряжение питания шкафа КП-М (ПС). Норма</div>
                <div class="col">Норма: 180-250 В</div>
            </td>
            <td>В</td>
            <td>217</td>
            <td>
                <div class="col">{{ $device->name }} №{{ $device->code }}</div>
                <div class="col">Класс точноcти {{ $device->class }}</div>
                <div class="col">Дата след. калибровки {{ $device->date }}</div>
            </td>
          </tr>
        </tbody>
    </table>
        {{-- controller file --}}
    <div class="col text-start">
        <div class="col">Для контроллера МКД</div>
        <div class="col">Имя файла прошивки - "ст.{{ $record->controlledPoint }}.mkd"</div>
    </div>
        {{-- TC table --}}
    <table class="table">
        <thead>
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
            <tr>
                <td>{{ $tc->name }}</td>
                <td>{{ $tc->klemm }}</td>
                <td>{{ $tc->number }}</td>
                <td>{{ $tc->invert }}</td>
                <td>{{ $tc->oper }}</td>
                <td>{{ $tc->DP }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
        {{-- TY table --}}
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Название сигнала</th>
            <th scope="col">Клемма КП-М (ПС)</th>
            <th scope="col">№ ТУ</th>
            <th scope="col">Оперативное название сигнала</th>
            <th scope="col">Соответствие сигнала с ДП</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($TY as $ty)
            <tr>
                <td>{{ $ty->name }}</td>
                <td>{{ $ty->klemm }}</td>
                <td>{{ $ty->number }}</td>
                <td>{{ $ty->oper }}</td>
                <td>{{ $ty->DP }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
        {{-- Conclusion --}}
    <div class="row">
        <div class="col">Заключение:
            {{ $record->conclusion }}
        </div>
    </div>
        {{-- Workers --}}
    <div class="row">
        <div class="col-12">Проверку проводил:</div>
        <div class="col-12"> {{ $worker1->position }} {{ $worker1->BIO }}</div>
        @if ($worker2 != null)
            <div class="col-12"> {{ $worker2->position }} {{ $worker2->BIO }}</div>
        @endif


    </div>
    <div class="row">
        <div class="col-12">Протокол проверил:</div>
        <div class="col-12"></div>
        <div class="col-12">Начальник РРУ Акудович Е.В.</div>
    </div>
</div>

@endsection
