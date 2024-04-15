<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rasa;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // user
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 1,
            'password' => Hash::make('admin321'),
        ]);
        User::create([
            'name' => 'super-admin',
            'email' => 'super-admin@gmail.com',
            'role' => '0',
            'password' => Hash::make('super-admin'),
        ]);
        // end

        // category
        Rasa::create([
            'varian_rasa' => 'Vanilla',
        ]);
        Rasa::create([
            'varian_rasa' => 'Coklat',
        ]);
        Rasa::create([
            'varian_rasa' => 'Sayur',
        ]);
        Rasa::create([
            'varian_rasa' => 'Buah Naga',
        ]);

        // end

        Product::factory()->count(4)->create();
    }
}
