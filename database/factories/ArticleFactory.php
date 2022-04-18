<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(mt_rand(2, 8)),
            "slug"  => $this->faker->slug(),
            "description"   => $this->faker->paragraph(),
            // "body"  => "<p>" . implode("</p><p>", $this->faker->paragraphs(mt_rand(5, 10) ) . "</p>",
            "body"  => collect($this->faker->paragraphs(mt_rand(20, 40)))
                ->map(fn ($parag) => "<p>$parag</p>")
                ->implode(''),
            'image' => 'article-images/default.jpg',
            'is_published' => mt_rand(0, 1),
            "user_id"  => mt_rand(1, 2), // from total users that generated in DatabaseSeeder.php
            "category_id"   => mt_rand(1, 2), // from total categories that generated in DatabaseSeeder.php
            "created_at" => $this->faker->dateTimeBetween('-1 years')
        ];
    }
}
