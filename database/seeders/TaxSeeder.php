<?php

namespace Database\Seeders;

use App\Models\Tax;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auth = User::first();
        Tax::insert([
            'id' => Str::uuid()->toString(),
            'name' => 'None',
            'tax' => 0,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $auth->id,
            'updated_by' => $auth->id
        ]);
    }
}
