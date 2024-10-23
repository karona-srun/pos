<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = [
            'title' => 'Site Settings',
            'sub-title' => 'Add / Update Site Settings',
            'site' => SiteSettings::first(),
            'currency' => Currency::orderBY('name')->get()
        ];
        return view('backend.site_settings.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator ::make($request->all(), [
            'site_name' => 'required|max:255',
            'timezone' => 'required',
            'date_format' => 'required',
            'time_format' => 'required',
            'language' => 'required',
            'currency' =>  'required',
            'prefix_product_category' =>  'required',
            'prefix_supplier' =>  'required',
            'prefix_purchase_return' =>  'required',
            'prefix_sale' =>  'required',
            'prefix_expense' =>  'required',
            'prefix_product' =>  'required',
            'prefix_purchase' =>  'required',
            'prefix_customer' =>  'required',
            'prefix_sale_return' =>  'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }


        if ($request->hasFile('site_logo')) {
            $site_logo = $request->file('site_logo')->store(options: 'logo');
        }

        $site = SiteSettings::find($id);
        $site->site_name = $request->site_name;
        $site->timezone = $request->timezone;
        $site->date_format = $request->date_format;
        $site->time_format = $request->time_format;
        $site->currency = $request->currency;
        $site->language = $request->language;
        $site->site_logo = $site_logo ?? null;
        $site->sale_invoice_footer_text = $request-> sale_invoice_footer_text;
        $site->invoice_terms_and_condition = $request-> invoice_terms_and_condition;
        $site->prefix_product_category = $request-> prefix_product_category;
        $site->prefix_supplier = $request-> prefix_supplier;
        $site->prefix_purchase_return = $request-> prefix_purchase_return;
        $site->prefix_sale = $request-> prefix_sale;
        $site->prefix_expense = $request->prefix_expense;
        $site->prefix_product = $request->prefix_product;
        $site->prefix_purchase = $request->prefix_purchase;
        $site->prefix_customer = $request->prefix_customer;
        $site->prefix_sale_return = $request->prefix_sale_return;
        $site->save();

        return redirect('site')->with('success', 'The '.$site->site_name.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiteSettings $siteSettings)
    {
        //
    }
}
