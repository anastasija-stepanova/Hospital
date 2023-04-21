<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'phone' => fake()->phoneNumber(),
            'working_start_time' => '10:00:00',
            'working_end_time' => '18:00:00',
            'date_of_birth' => fake()->date(),
            'middle_name' => fake()->name(),
            'email' => fake()->email(),
        ];
    }
}
