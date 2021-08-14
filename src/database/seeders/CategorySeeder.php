<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                "sort" => 1,
                "name" => "HTML/CSS",
                "is_published" => true,
            ],
            [
                "sort" => 2,
                "name" => "Javascript",
                "is_published" => true,
            ],
            [
                "sort" => 3,
                "name" => "Python",
                "is_published" => true,
            ],
            [
                "sort" => 4,
                "name" => "Java",
                "is_published" => true,
            ],
            [
                "sort" => 5,
                "name" => "PHP",
                "is_published" => true,
            ],
        ]);
        // Category::factory()
        //     ->count(10)
        //     ->create();
    }
}
