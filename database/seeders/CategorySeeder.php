<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Category::truncate();
        Category::create([
            "name"  => "Umum",
            "slug"  => "umum"
        ]);
        Category::create([
            "name"  => "OSIS",
            "slug"  => "osis"
        ]);
        Category::create([
            "name"  => "Pengumuman",
            "slug"  => "pengumuman"
        ]);
    }
}
