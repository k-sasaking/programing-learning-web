<?php

namespace Database\Factories;

use App\Models\Lecture;
use Illuminate\Database\Eloquent\Factories\Factory;

class LectureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lecture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "section_id" => $this->faker->numberBetween($min = 1, $max = 100),
            "sort" => $this->faker->numberBetween($min = 1, $max = 50),
            "title" => $this->faker->word(),
            "text" => $this->faker->paragraph(),
        ];
    }
}
