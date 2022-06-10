<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
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
            'nuptk' =>  $this->faker->numerify('################'),
            'nip' =>  $this->faker->numerify('################'),
            'address' =>  $this->faker->address(),
            'jenis_ptk' =>  "Contoh Jenis PTK " . $this->faker->numerify('##'),
            'tugas_tambahan' =>  "Contoh Tugas Tambahan " . $this->faker->numerify('##'),
            'golongan' =>  "Contoh Golongan " . $this->faker->numerify('##')
        ];
    }
}
