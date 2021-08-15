<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(LectureSeeder::class);
    }
}
