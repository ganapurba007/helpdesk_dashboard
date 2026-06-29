<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Master data seeders
            RoleSeeder::class,
            DepartmentSeeder::class,
            CategorySeeder::class,
            StatusSeeder::class,
            PrioritySeeder::class,

            // User seeder (must be after Role & Department)
            UserSeeder::class,

            // Ticket related seeders
            TicketSeeder::class,
            TicketReplySeeder::class,
            TicketHistorySeeder::class,
        ]);
    }
}
