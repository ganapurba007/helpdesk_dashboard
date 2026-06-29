<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role_name' => 'admin', 'description' => 'Administrator'],
            ['role_name' => 'support', 'description' => 'Support team member'],
            ['role_name' => 'staff', 'description' => 'Employee who can create tickets'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
