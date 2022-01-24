<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChoiceFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $question = Question::factory()->create();
        return [
            "label" => "",
            "question_id" => $question->getKey(),
            "correct" => $this->faker->boolean
        ];
    }
}
