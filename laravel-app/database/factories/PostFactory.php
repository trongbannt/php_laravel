<?php

namespace Database\Factories;
use Illuminate\Support\Str; #add using that

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Post :: class;
    public function definition()
    {
        return [
            "title" => $this->faker->title,
            "body" => $this->faker->paragraph,
            "created_at" => now(),
        ];
    }
}
