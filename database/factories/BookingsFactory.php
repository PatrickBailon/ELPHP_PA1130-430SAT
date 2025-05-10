<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bookings>
 */
class BookingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pickup = $this->faker->dateTimeBetween('now', '+1 week');
        $return = (clone $pickup)->modify('+'.rand(1, 7).' days');

        return [
            'users_id' => \App\Models\User::factory(),
            'vehicles_id' => \App\Models\Vehicle::factory(),
            'pickup_date' => $pickup->format('Y-m-d'),
            'return_date' => $return->format('Y-m-d'),
            'total_price' => $this->faker->randomFloat(2, 1000, 30000),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
