<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['title' => 'Open', 'color' => '#3B82F6'],          // Blue
            ['title' => 'Assigned', 'color' => '#F59E0B'],      // Amber
            ['title' => 'In Progress', 'color' => '#8B5CF6'],   // Purple
            ['title' => 'Resolved', 'color' => '#10B981'],      // Green
            ['title' => 'Closed', 'color' => '#6B7280'],        // Gray
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
