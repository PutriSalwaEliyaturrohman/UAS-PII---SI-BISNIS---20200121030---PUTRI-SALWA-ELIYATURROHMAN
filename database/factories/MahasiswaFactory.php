<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_mahasiswa' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail,
            'no_telp' => rand(18, 23),
            'alamat' => $this->faker->address()            
        ];
    }
}
