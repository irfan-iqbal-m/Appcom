<?php

namespace  Database\Seeders;

use App\Models\Category;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (!Category::where('title', 'Visa')->exists()) {
            $category = new Category();
            $category->title = 'Visa';
            $category->save();
        }
        if (!Category::where('title', 'Passport')->exists()) {
            $category = new Category();
            $category->title = 'Passport';
            $category->save();
        }
    }
}
