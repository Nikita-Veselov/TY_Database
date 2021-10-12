<?php

namespace Database\Factories;

use App\Models\TC;
use Illuminate\Database\Eloquent\Factories\Factory;

class TCFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TC::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'klemm' => $this->faker->randomNumber(3, false),
            'number' => $this->faker->randomNumber(3, false),
            'invert' => $this->faker->boolean(),
            'oper' => $this->faker->word(),
            'DP' => $this->faker->word(),
            'CP' => $this->faker->word(),
            'cp-code' => '1',
        ];
    }
}
