<?php

namespace Database\Seeders;

use App\Models\Devices;
use App\Models\User;
use App\Models\Workers;
use Illuminate\Database\Seeder;

class DefaultStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // setting defult admin login/pass
        User::factory(1)->create();

        // creating basic users
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

        // Adding basic device
        Devices::factory(1)
            ->state([
                'code' => '№10188866',
                'name' => 'Мультиметр ProsKit',
                'class' => '0.5',
                'date' => '1 кв. 2021'
            ])
            ->create();
    }
}
