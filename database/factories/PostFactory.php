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
    public function definition()
    {
        return [
            'title' => fake()->sentence(mt_rand(3,5)),
            'slug' => fake()->unique()->slug(mt_rand(3,5)),
            'category_id' => mt_rand(1,5),
            'user_id' => mt_rand(1,5),
            'excerpt' => fake()->text(200),
            'body' => collect(fake()->paragraphs(mt_rand(8,15)))
                        ->map(fn($p) => "<p>$p</p>")
                        ->implode(''),
            'is_publish' => mt_rand(0,1),
            'published_at' => fake()->dateTimeInInterval('-2 years', '+8 months'),
        ];
    }
}
