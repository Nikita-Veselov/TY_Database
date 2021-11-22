<?php

namespace Database\Seeders;

use App\Models\Devices;
use Illuminate\Database\Seeder;

class DevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Devices::factory(1)
            ->state([
                'code' => 'test',
                'name' => 'test-device',
                'class' => 'test-device-class',
                'date' => 'test-device-date'
            ])
            ->create();
        Devices::factory()
            ->count(14)
            ->create();
    }
}
