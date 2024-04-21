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

        // Generate a random word as the image filename
        $imageFilename = $faker->word() . '.jpg';

        // Destination directory for the image
        $destinationPath = public_path('images/places');

        // If the destination directory doesn't exist, create it
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        // Copy a placeholder image to the destination directory
        $placeholderImagePath = public_path('images/placeholder.jpg');
        $destinationImagePath = $destinationPath . '/' . $imageFilename;
        File::copy($placeholderImagePath, $destinationImagePath);

        return [
            'name' => $faker->name(),
            'image' => $imageFilename,
        ];
    }
}
