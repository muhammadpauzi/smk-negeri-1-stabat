<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Major::truncate();
        Major::insertOrIgnore([
            [
                "name" => "Teknik Komputer & Jaringan",
                "slug" => "teknik-komputer-&-jaringan",
                "description" => "-",
                "head_of_major_id" => "1",
            ],
            [
                "name" => "Teknik Pemesinan",
                "slug" => "teknik-pemesinan",
                "description" => "-",
                "head_of_major_id" => "1",
            ],
        ]);
    }
}
