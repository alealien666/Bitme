<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "rasa_id" => mt_rand(1, 4),
            "nama_product" => fake()->sentence(1),
            "deskripsi" => fake()->paragraph(3, 5),
            "harga" => 10000,
            "stok" => 10,
            "tanggal_expired" => fake()->date()
        ];
    }
}
