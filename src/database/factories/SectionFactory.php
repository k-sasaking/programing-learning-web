<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Section::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "lesson_id" => $this->faker->numberBetween($min = 1, $max = 30),
            "sort" => $this->faker->numberBetween($min = 1, $max = 30),
            "name" => $this->faker->word(),
        ];
    }
}
