<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ViewPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => mt_rand(1,20),
            'ip_visitor' => fake()->localIpv4(),
            'access_at' => fake()->dateTimeInInterval('-1 years', '+12 months'),
        ];
    }
}
