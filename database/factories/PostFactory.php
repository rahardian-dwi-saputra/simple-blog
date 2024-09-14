<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(mt_rand(3,5)),
            'slug' => fake()->unique()->slug(mt_rand(3,5)),
            'category_id' => mt_rand(1,5),
            'author_id' => mt_rand(1,3),
            'is_publish' => mt_rand(0,1),
            'excerpt' => fake()->text(200),
            'body' => collect(fake()->paragraphs(mt_rand(8,15)))
                        ->map(fn($p) => "<p>$p</p>")
                        ->implode(''),
            'created_at' => fake()->dateTimeInInterval('-2 years', '+8 months'),
        ];
    }
}
