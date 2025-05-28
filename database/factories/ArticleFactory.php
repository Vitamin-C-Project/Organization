<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(100),
            'slug' => str($this->faker->text(100))->slug(),
            'content' => $this->faker->text(),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->boolean(),
            'created_by' => $this->faker->name(),
        ];
    }
}
