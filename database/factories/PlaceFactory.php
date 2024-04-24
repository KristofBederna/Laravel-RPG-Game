<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();

        $imageFilename = $faker->word() . '.jpg';

        $destinationPath = public_path('images/places');

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $placeholderImagePath = public_path('images/placeholder.jpg');
        $destinationImagePath = $destinationPath . '/' . $imageFilename;
        File::copy($placeholderImagePath, $destinationImagePath);

        return [
            'name' => $faker->name(),
            'image' => $imageFilename,
        ];
    }
}
