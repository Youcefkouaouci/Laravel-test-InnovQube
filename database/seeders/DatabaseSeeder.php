<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un utilisateur admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Créer des utilisateurs de test
        $users = User::factory(10)->create();

        // Créer des propriétés
        $properties = Property::factory(20)->create();

        // Créer des réservations pour certains utilisateurs
        foreach ($users as $user) {
            $numberOfBookings = rand(0, 3);

            for ($i = 0; $i < $numberOfBookings; $i++) {
                $property = $properties->random();
                $startDate = now()->addDays(rand(1, 60));
                $endDate = $startDate->copy()->addDays(rand(2, 7));
                $nights = $startDate->diffInDays($endDate);

                Booking::create([
                    'user_id' => $user->id,
                    'property_id' => $property->id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'total_price' => $nights * $property->price_per_night,
                    'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
                ]);
            }
        }
    }
}
