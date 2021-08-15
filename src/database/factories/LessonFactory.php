<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomNum = $this->faker->numberBetween($min = 1, $max = 5);
        $namePrefix = array('Web', 'Javascript', 'Python', 'Java', 'PHP');
        $name = $namePrefix[$randomNum-1].($this->faker->randomElement(['入門', '基礎', '応用', '実践']));
        return [
            "category_id" => $randomNum,
            "sort" => $this->faker->numberBetween($min = 1, $max = 50),
            "name" => $name.($this->faker->word()),
            "description" => $this->faker->sentence(),
            "thumbnail_path" => $this->faker->unique()->imageUrl,
        ];
    }
}
