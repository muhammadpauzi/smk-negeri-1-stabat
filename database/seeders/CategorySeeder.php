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
        Category::insertOrIgnore([
            [
                "name"  => "Umum",
                "slug"  => "umum"
            ],
            [
                "name"  => "OSIS",
                "slug"  => "osis"
            ], [
                "name"  => "Pengumuman",
                "slug"  => "pengumuman"
            ]
        ]);
    }
}
