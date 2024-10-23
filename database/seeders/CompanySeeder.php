<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use App\Models\User;
use Faker\Core\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auth = User::first();
        CompanyProfile::insert([
            'id' => Str::uuid()->toString(),
            'company_name' => 'POS Co,.lte',
            'mobile' => '023773007',
            'email' => 'karonaadmin@pos.com',
            'phone' => '086773007',
            'gst_number' => 'SHA12345',
            'vat_number' => '0913932',
            'pan_number' => '2332422',
            'website' => 'https://karonasrun.com',
            'show_signature' => false,
            'signature_image' => '',
            'country' => 'Cambodia',
            'state' => 'Cambodia',
            'city' => 'Phnom Penh',
            'postcode' => '12000',
            'address' => '48-46 Prey Nokor St. (126), Phnom Penh, Cambodia',
            'company_logo' => '',
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $auth->id,
            'updated_by' => $auth->id
        ]);
    }
}
