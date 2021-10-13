<?php

namespace Database\Factories;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber(3, false),
            'type' => $this->faker->word(),
            'date' => $this->faker->date(),
            'controlledPoint' => $this->faker->word(),
            'device' => $this->faker->word(),
            'UTY' => $this->faker->randomNumber(2, false),
            'UTC' => $this->faker->randomNumber(2, false),
            'UTP' => $this->faker->randomNumber(3, false),
            'conclusion' => $this->faker->word(),
            'worker1' => $this->faker->name(),
            'worker2' => $this->faker->name(),
        ];
    }
}
