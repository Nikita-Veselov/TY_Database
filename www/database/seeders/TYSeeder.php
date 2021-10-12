<?php

namespace Database\Seeders;

use App\Models\ControlledPoint;
use App\Models\TY;
use Illuminate\Database\Seeder;

class TYSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TY::factory()
            ->count(10)
            ->for(ControlledPoint::factory()->state([
                'code' => 'test',
            ]))
            ->create();
    }
}
