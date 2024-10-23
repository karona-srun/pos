<?php

namespace Database\Seeders;

use App\Models\SiteSettings;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auth = User::first();
        SiteSettings::insert([
            'id' => Str::uuid()->toString(),
            'site_name' => 'Ultimate Inventory with POS',
            'timezone' => 'Asia/Phnom_Penh',
            'date_format' => 'dd-mm-yyyy',
            'time_format' => '12',
            'currency' => 'USD',
            'language' => 'EN',
            'site_logo' => '',
            'sale_invoice_footer_text' => 'This is footer text. You can set it from Site Settings.',
            'invoice_terms_and_condition' => "1. No warranty for damaged or burnt goods.\n2. For warranty/repairs/replacement bring invoice copy.\n3. Interest @24% will be charged if bills are not paid within the due date.\n4. We reserve lien on goods till full payment is made.",
            'prefix_product_category' => 'PCT',
            'prefix_supplier' => 'SP',
            'prefix_purchase_return' => 'PR',
            'prefix_sale' => 'SL',
            'prefix_expense' => 'EX',
            'prefix_product' => 'PRO',
            'prefix_purchase' => 'PU',
            'prefix_customer' => 'CU',
            'prefix_sale_return' => 'SLR',
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $auth->id,
            'updated_by' => $auth->id
        ]);
    }
}
