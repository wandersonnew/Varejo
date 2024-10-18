<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specificCategories = [
            ['name' => 'Eletrônicos'],
            ['name' => 'Roupas'],
            ['name' => 'Alimentos'],
            ['name' => 'Livros'],
            ['name' => 'Móveis']
        ];

        foreach ($specificCategories as $category) {
            Category::create($category);
        }

        Category::factory()->count(10)->create();
    }
}
