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
        Workers::factory(1)
            ->state([
                'position' => 'Начальник РРУ',
                'BIO' => 'Акудович Евгений Викторович',
                'signature' => 1,
            ])
            ->create();

        Workers::factory(1)
            ->state([
                'position' => 'ст.эл.мех.',
                'BIO' => 'Соколов Евгений Игоревич',
                'signature' => 1,
            ])
            ->create();

        Workers::factory(1)
            ->state([
                'position' => 'эл.мех.',
                'BIO' => 'Веселов Никита Вадимович',
                'signature' => 1,
            ])
            ->create();

        Workers::factory()
            ->count(12)
            ->create();
    }
}
