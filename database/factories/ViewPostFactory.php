<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ViewPost>
 */
class ViewPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = array('Anonymous','Admin','User');
        return [
            'post_id' => mt_rand(1,20),
            'user' => $users[mt_rand(0,2)],
            'visitor' => fake()->localIpv4(),
            'access_at' => fake()->dateTimeInInterval('-1 years', '+12 months'),
        ];
    }
}
