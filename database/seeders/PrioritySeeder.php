<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = [
            ['title' => 'Low', 'level' => 1, 'color' => '#10B981'],       // Green
            ['title' => 'Medium', 'level' => 2, 'color' => '#F59E0B'],    // Amber
            ['title' => 'High', 'level' => 3, 'color' => '#EF4444'],      // Red
            ['title' => 'Urgent', 'level' => 4, 'color' => '#DC2626'],    // Dark Red
        ];

        foreach ($priorities as $priority) {
            Priority::create($priority);
        }
    }
}
