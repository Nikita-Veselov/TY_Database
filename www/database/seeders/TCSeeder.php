<?php

namespace Database\Seeders;

use App\Models\ControlledPoint;
use App\Models\TC;
use Illuminate\Database\Seeder;

class TCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TC::factory()
            ->count(10)
            ->for(ControlledPoint::factory()->state([
                'code' => 'test',
            ]))
            ->create();
    }
}
