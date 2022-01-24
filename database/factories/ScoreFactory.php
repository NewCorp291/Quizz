<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => $this->faker->randomNumber(1),
            "quiz_id" => $this->faker->randomNumber(1),
            "score" => $this->faker->randomNumber(1)*2,
        ];
    }
}
