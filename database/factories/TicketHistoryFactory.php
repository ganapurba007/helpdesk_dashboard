<?php

namespace Database\Factories;

use App\Models\TicketHistory;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket_history>
 */
class TicketHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_id' => Ticket::inRandomOrder()->value('id'),
            'user_id' => fake()->numberBetween(4, 14),
            'old_status_id' => fake()->numberBetween(1, 5),
            'new_status_id' => fake()->numberBetween(1, 5),
            'note' => fake()->paragraph(),
        ];
    }
}
