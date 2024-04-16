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
        // Admin felhasználó létrehozása
        User::factory()->create([
            'name' => 'Admin',
            'email' => fake()->unique()->safeEmail,
            'password' => bcrypt('adminpassword'),
            'admin' => true,
        ]);

        User::factory(3)->create();

        // Helyszínek létrehozása
        $places = Place::factory(3)->create();

        // Karakterek létrehozása
        $characters = Character::factory(5)->create(['enemy' => false]);
        $enemyCharacters = Character::factory(3)->create(['enemy' => true]);

        // Versenyek létrehozása
        foreach ($places as $place) {
            $contest = Contest::factory()->create([
                'place_id' => $place->id,
                'user_id' => User::where('admin', true)->first()->id, // Admin felhasználó id-ja
            ]);

            // Versenyhez karakterek hozzárendelése
            $contest->characters()->attach($characters->random(), [
                'hero_hp' => 100, // Kezdeti életerő
                'enemy_hp' => 100,
            ]);
            $contest->characters()->attach($enemyCharacters->random(), [
                'hero_hp' => 100,
                'enemy_hp' => 100,
            ]);
        }
    }
}
