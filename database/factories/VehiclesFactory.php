<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicles>
 */
class VehiclesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'users_id' => \App\Models\User::factory(),
            'vehicles_name' => $this->faker->word . ' ' . $this->faker->colorName,
            'plate_number' => strtoupper($this->faker->bothify('???-####')),
            'model' => $this->faker->word . ' ' . $this->faker->year,
            'fuel_type' => $this->faker->randomElement(['Gasoline', 'Diesel', 'Electric']),
            'price_per_day' => $this->faker->randomFloat(2, 500, 5000),
            'location' => $this->faker->city,
        ];
    }
}
