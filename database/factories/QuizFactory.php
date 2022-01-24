<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class QuizFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'label' => $this->faker->company,
            'published' => $this->faker->boolean,
        ];
    }
}
