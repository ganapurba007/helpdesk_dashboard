<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Create Admin user
    User::create([
      'name' => 'Admin',
      'email' => 'admin@helpdesk.com',
      'password' => bcrypt('password'),
      'phone' => '081234567890',
      'avatar' => null,
      'department_id' => 1, // IT Support
      'role_id' => 3, // Admin
      'email_verified_at' => now(),
    ]);

    // Create Support users
    User::create([
      'name' => 'Support 1',
      'email' => 'support1@helpdesk.com',
      'password' => bcrypt('password'),
      'phone' => '081234567891',
      'avatar' => null,
      'department_id' => 1, // IT Support
      'role_id' => 2, // Support
      'email_verified_at' => now(),
    ]);

    User::create([
      'name' => 'Support 2',
      'email' => 'support2@helpdesk.com',
      'password' => bcrypt('password'),
      'phone' => '081234567892',
      'avatar' => null,
      'department_id' => 1, // IT Support
      'role_id' => 2, // Support
      'email_verified_at' => now(),
    ]);

    // Create Employee users
    User::factory(10)->create([
      'role_id' => 1, // Employee
    ]);
  }
}
