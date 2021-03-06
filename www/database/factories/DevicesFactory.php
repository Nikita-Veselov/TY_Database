<?php

namespace Database\Factories;

use App\Models\Devices;
use Illuminate\Database\Eloquent\Factories\Factory;

class DevicesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Devices::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->word(),
            'name' => $this->faker->word(),
            'class' => $this->faker->word(),
            'date' => $this->faker->date('Y_m'),
        ];
    }
}
