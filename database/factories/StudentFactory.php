<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' =>  $this->faker->name(),
            'nisn' =>  $this->faker->numerify('##########'),
            'gender' => ['pria', 'wanita'][mt_rand(0, 1)],
            'place_of_birth' =>  $this->faker->address(),
            'date_of_birth' => $this->faker->dateTime(),
            'religion' =>  ['islam', 'katolik', 'protestan', 'hindu', 'buddha'][mt_rand(0, 4)],
            'address' =>  $this->faker->address(),
            'rombongan_belajar' =>  "Contoh Rombel " . $this->faker->numerify('##')
        ];
    }
}
