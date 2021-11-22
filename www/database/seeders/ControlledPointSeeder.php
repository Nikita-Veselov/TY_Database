<?php

namespace Database\Seeders;

use App\Models\ControlledPoint;
use App\Models\Record;
use App\Models\TC;
use App\Models\TY;
use Illuminate\Database\Seeder;

class ControlledPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ControlledPoint::factory(1)
            ->state([
                'code' => 'test',
                'name' => 'test-name',
                'type' => 'test-type'
            ])
            ->has(Record::factory()
                ->state([
                    'worker1' => 'Веселов Никита Вадимович',
                    'worker2' => 'Соколов Евгений Игоревич',
                    'device' => 'test-device'
                ])
                ->count(1))
            ->has(TC::factory()->count(10))
            ->has(TY::factory()->count(10))
            ->create();

        ControlledPoint::factory()
            ->has(Record::factory()
                    ->state([
                        'worker1' => 'Веселов Никита Вадимович',
                        'worker2' => 'Соколов Евгений Игоревич',
                        'device' => 'test-device'
                    ])
                    ->count(1))
            ->count(14)
            ->create();
    }
}
