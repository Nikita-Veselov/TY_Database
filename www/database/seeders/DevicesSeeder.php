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
        Devices::factory()
            ->count(8)
            ->create();
    }
}
