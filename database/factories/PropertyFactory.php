<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        $locations = ['Paris', 'Lyon', 'Marseille', 'Toulouse', 'Nice', 'Bordeaux', 'Lille', 'Nantes', 'Strasbourg', 'Montpellier'];

        return [
            'name' => $this->faker->words(3, true) . ' - ' . $this->faker->randomElement(['Appartement', 'Maison', 'Villa', 'Studio']),
            'description' => $this->faker->paragraphs(3, true),
            'price_per_night' => $this->faker->randomFloat(2, 50, 500),
            'location' => $this->faker->randomElement($locations),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 3),
            'max_guests' => $this->faker->numberBetween(2, 10),
            'is_available' => $this->faker->boolean(90),
        ];
    }
}
