<?php

namespace Database\Seeders;

use App\Models\ControlledPoint;
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
        ControlledPoint::factory()
            ->count(20)
            ->create();
    }
}
