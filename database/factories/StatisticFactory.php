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
            'referer_host'=>$this->faker->freeEmailDomain(),
            'user_agent'=>$this->faker->userAgent(),
            'session_id'=>$this->faker->md5(),
            'datetime_end' => $this->faker->iso8601(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
