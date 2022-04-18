<?php

namespace Database\Seeders;

use App\Models\Article;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{

    protected $model = Article::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::truncate();
        Article::factory()->count(100)->create();
    }
}
