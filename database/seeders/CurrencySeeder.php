<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auth = User::first();
        Currency::insert([
            'id' => Str::uuid()->toString(),
            'name' => 'USD - US Dollar (USD)($)',
            'signal' => '$',
            'remark' => 'USD Description',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $auth->id,
            'updated_by' => $auth->id
        ]);
        Currency::insert([
            'id' => Str::uuid()->toString(),
            'name' => 'KHR - Cambodian Riel (Riel)(៛)',
            'signal' => '៛',
            'remark' => 'KHR Description',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $auth->id,
            'updated_by' => $auth->id
        ]);
    }
}
