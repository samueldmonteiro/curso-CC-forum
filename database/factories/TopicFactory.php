<?php

namespace Database\Factories;

use App\Models\Matter;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->paragraph(3),
            'matter_id' => Matter::factory(),
            'uri' => (new Topic)->generateUri(),
            'content' => fake()->paragraph(6),
            'state' => fake()->boolean()
        ];
    }
}
