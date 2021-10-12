@extends('layouts.main')

@section('content')


<div class="container">
    <div class="title col text-center">Протокол технического обсложивания стойки телемеханики КП-М (ПС) в объеме
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
    <div class="col text-center">
        ст. {{ $record->controlledPoint }}
    </div>
    <div class="col text-center">№{{ $record->number }}</div>
    <div class="col text-center">
        {{ $record->date }}
    </div>
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
    <table class="table">
        <thead>
          <tr>
            <th scope="col-4">Проверяемый показатель (характеристика)</th>
            <th scope="col-2">Еденица измерения</th>
            <th scope="col-2">Значение</th>
            <th scope="col-4">Наименование средства измерения или оборудования</th>
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
                <div class="col">6. апряжение питания шкафа КП-М (ПС). Норма</div>
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

    <div class="col text-start">
        <div class="col">Для контроллера МКД</div>
        <div class="col">Имя файла прошивки - "ст.{{ $record->controlledPoint }}.mkd"</div>
    </div>
    <div class="col">
        <div class="row">
            @foreach ($TC as $sig)
                <div class="col">{{ $sig->name }}</div>
            @endforeach
        </div>
    </div>
    <div class="col">
        <div class="row">
            @foreach ($TY as $sig)
                <div class="col">{{ $sig->name }}</div>
            @endforeach
        </div>
    </div>

    <div class="col text-center">{{ $record->worker }}</div>
</div>



@endsection
