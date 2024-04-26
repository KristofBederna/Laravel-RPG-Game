<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Character;
use App\Models\Contest;
use App\Models\Place;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('adminpassword'),
            'admin' => true,
        ]);

        User::factory(3)->create();

        $places = Place::factory(3)->create();

        $characters = Character::factory(5)->create(['enemy' => false]);
        $enemyCharacters = Character::factory(3)->create(['enemy' => true]);

        foreach ($places as $place) {
            $contest = Contest::factory()->create([
                'win' => fake()->randomElement([null, 1]),
                'place_id' => $place->id,
                'user_id' => User::where('admin', true)->first()->id,
                'history' => "",
            ]);
            for ($i = 0; $i < fake()->numberBetween(1, 5); $i++) {
                $contest->history .= fake()->randomElement(['melee ', 'ranged ', 'magic ']);
            }
            if ($contest->win == null) {
                $contest->characters()->attach($characters->random(), [
                    'hero_hp' => fake()->numberBetween(1,20),
                    'enemy_hp' => fake()->numberBetween(1,20),
                ]);
                $contest->characters()->attach($enemyCharacters->random(), [
                    'hero_hp' => fake()->numberBetween(1,20),
                    'enemy_hp' => fake()->numberBetween(1,20),
                ]);
            } else {
                $contest->characters()->attach($characters->random(), [
                    'hero_hp' => fake()->numberBetween(1,20),
                    'enemy_hp' => 0,
                ]);
                $contest->characters()->attach($enemyCharacters->random(), [
                    'hero_hp' => fake()->numberBetween(1,20),
                    'enemy_hp' => 0,
                ]);
            }
        }
    }
}
