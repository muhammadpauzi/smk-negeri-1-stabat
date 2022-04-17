<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slide>
 */
class SlideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(4, 6)),
            'subtitle' => mt_rand(0, 1) === 1 ? $this->faker->sentence(mt_rand(12, 20)) : null,
            'url' => mt_rand(0, 1) === 1 ? "http://localhost:8000" : null,
            'image' => 'slide-images/default.jpg'
        ];
    }
}
