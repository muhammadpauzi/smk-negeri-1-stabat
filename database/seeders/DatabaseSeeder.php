<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();
        Slide::factory(5)->create();
        $this->call([
            ArticleSeeder::class,
            CategorySeeder::class,
            MajorSeeder::class,
            StudentSeeder::class,
            TeacherSeeder::class,
            UserSeeder::class,
            SchoolProfileSeeder::class
        ]);
    }
}
