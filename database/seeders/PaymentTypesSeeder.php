<?php

namespace Database\Seeders;

use App\Models\PaymentTypes;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auth = User::first();
        PaymentTypes::insert([
            'id' => Str::uuid()->toString(),
            'name' => 'None',
            'remark' => 'None Description',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $auth->id,
            'updated_by' => $auth->id
        ]);
    }
}
