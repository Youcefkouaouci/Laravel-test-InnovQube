<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+2 months');
        $endDate = $this->faker->dateTimeBetween($startDate, '+3 months');
        $nights = $startDate->diff($endDate)->days;

        return [
            'user_id' => User::factory(),
            'property_id' => Property::factory(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_price' => $nights * $this->faker->randomFloat(2, 50, 500),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
