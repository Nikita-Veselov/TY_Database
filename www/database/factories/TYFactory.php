<?php

namespace Database\Factories;

use App\Models\TY;
use Illuminate\Database\Eloquent\Factories\Factory;

class TYFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TY::class;

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
            'oper' => $this->faker->word(),
            'DP' => $this->faker->word(),
            'cp-code' => '1',
        ];
    }
}
