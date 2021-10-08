<?php

namespace Database\Seeders;

use App\Models\Workers;
use Illuminate\Database\Seeder;
use Illuminate\Queue\Worker;

class WorkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Workers::factory()
            ->count(5)
            ->create();
    }
}
