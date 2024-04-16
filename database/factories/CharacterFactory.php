<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $totalPoints = $this->faker->numberBetween(0, 20);
        $defence = $this->faker->numberBetween(0, min($totalPoints, 3));
        $totalPoints -= $defence;
        $strength = $this->faker->numberBetween(0, min($totalPoints, 20));
        $totalPoints -= $strength;
        $accuracy = $this->faker->numberBetween(0, min($totalPoints, 20));
        $totalPoints -= $accuracy;
        $magic = min($totalPoints, 20);

        return [
            'user_id' => User::factory()->create()->id,
            'name' => $this->faker->name,
            'enemy' => false,
            'defence' => $defence,
            'strength' => $strength,
            'accuracy' => $accuracy,
            'magic' => $magic,
        ];
    }
}
