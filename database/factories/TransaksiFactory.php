<?php

namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'no_transaksi' => $this->faker->unique()->randomNumber(),
            'id_pelanggan' => User::factory(), // Menggunakan factory pengguna untuk mengaitkan transaksi dengan pengguna
            'tgl_pesan' => $this->faker->date(),
            'tgl_acara' => $this->faker->date(),
            'waktu_acara' => $this->faker->time(),
            'catatan' => $this->faker->sentence(),
            'total_harga' => $this->faker->randomFloat(2, 0, 1000),
            'tgl_bayar' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Belum Lunas', 'Lunas', 'Tolak']),
            'bukti_dp' => $this->faker->imageUrl(),
            'bukti_lunas' => $this->faker->imageUrl(),
            'norek_pelanggan' => $this->faker->creditCardNumber(),
            'bank_pelanggan' => $this->faker->company(),
            'atasnama_pelanggan' => $this->faker->name(),
            'total_refund' => $this->faker->randomFloat(2, 0, 1000),
            'bukti_refund' => $this->faker->imageUrl(),

        ];
    }
}