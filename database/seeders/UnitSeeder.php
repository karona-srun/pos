<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auth = User::first();
        Unit::insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Packets',
            'remark' => 'Packets Description',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $auth->id,
            'updated_by' => $auth->id
        ]);

        Unit::insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Box',
            'remark' => 'Box Description',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $auth->id,
            'updated_by' => $auth->id
        ]);
    }
}
