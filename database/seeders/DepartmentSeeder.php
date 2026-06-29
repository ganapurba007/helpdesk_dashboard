<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['department_name' => 'IT Support', 'description' => 'Departemen IT Support'],
            ['department_name' => 'HR', 'description' => 'Departemen Human Resources'],
            ['department_name' => 'Finance', 'description' => 'Departemen Keuangan'],
            ['department_name' => 'Marketing', 'description' => 'Departemen Marketing'],
            ['department_name' => 'Operations', 'description' => 'Departemen Operations'],
            ['department_name' => 'Development', 'description' => 'Departemen Development'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
