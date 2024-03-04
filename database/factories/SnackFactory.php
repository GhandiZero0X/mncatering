<?php

namespace Database\Factories;

use App\Models\Snack;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SnackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_snack' => $this->faker->word,
            'harga' => $this->faker->randomNumber(4),
            'deskripsi' => $this->faker->sentence,
            'gambar' => $this->faker->image('public/fotoSnack', 200, 200, null, false),
        ];
    }
}