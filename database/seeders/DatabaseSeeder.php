<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // \App\Models\User::create([
        //     'name' => "Karona Srun",
        //     'email' => "admin@gmail.com",
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'remember_token' => Str::random(10),
        // ]);
        $this->call([
            // TaxSeeder::class,
            // UnitSeeder::class,
            // PaymentTypesSeeder::class
            // CurrencySeeder::class
            // CompanySeeder::class,
            // SiteSeeder::class,
        ]);
    }
}
