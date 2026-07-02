<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_number' => 'TCK' . fake()->unique()->randomNumber(),
            'user_id' => fake()->numberBetween(4, 14),
            'assigned_to' => fake()->numberBetween(3, 15),
            'category_id' => fake()->numberBetween(1, 5),
            'priority_id' => fake()->numberBetween(1, 4),
            'status_id' => fake()->numberBetween(1, 5),
            'subject' => fake()->sentence(),
            'description' => fake()->paragraph(),
        ];
    }
}
