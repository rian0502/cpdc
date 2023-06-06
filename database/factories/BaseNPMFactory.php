<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BaseNPM>
 */
class BaseNPMFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'npm' => $this->faker->unique()->randomNumber(8),
            'status' => 'nonaktif',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
