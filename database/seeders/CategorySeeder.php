<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();

        $categories = [
            ['name' => 'Hardware', 'description' => 'Masalah terkait perangkat keras komputer'],
            ['name' => 'Software', 'description' => 'Masalah terkait aplikasi dan software'],
            ['name' => 'Network', 'description' => 'Masalah terkait jaringan dan koneksi internet'],
            ['name' => 'Email', 'description' => 'Masalah terkait email dan komunikasi'],
            ['name' => 'Access', 'description' => 'Masalah akses dan permission'],
            ['name' => 'Database', 'description' => 'Masalah terkait database dan data'],
            ['name' => 'Other', 'description' => 'Kategori lainnya'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        Schema::enableForeignKeyConstraints();
    }
}
