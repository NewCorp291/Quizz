<?php

namespace Database\Factories;

use App\Models\Choice;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    private $question = [
        "What's the name of this company's boss ?",
        "How many employees does this company have ?",
        "How long can you go on vacation per year ?",
        "What's the limit of coffee you can drink a day ?",
        "What should you do in case of fire ?"
    ];
    private $choices = [
        "What's the name of this company's boss ?" => [

        ]
    ];
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Choice::factory(1)->create(["label" => $this->faker->randomElement($this->question)]);
        $question = $this->faker->randomElement($this->question);
        return [
            "label" => $question,
            "quiz_id" => $this->faker->randomNumber([1, 10]),
            "type" => $question == "What should you do in case of fire ?" ? "multiple" : "single",
        ];
    }

}
