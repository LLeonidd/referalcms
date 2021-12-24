<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StatisticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'source_host'=>$this->faker->freeEmailDomain(),
            'datetime_end' => $this->faker->iso8601(),
        ];
    }
}
