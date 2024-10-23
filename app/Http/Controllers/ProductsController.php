<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Products;
use App\Models\ProductTypes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $products = Products::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('remark', 'like', '%' . $search . '%');
        })->paginate(10);

        $datas = [
            'title' => 'Products',
            'data' => $products
        ];

        return view('backend.products.index', ['datas' => $datas, 'products' => $products, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = [
            'title' => 'Create Products',
            'product_type' => ProductTypes::orderBy('name')->where('status', 1)->get(),
            'discount' => Discount::orderBy('name')->where('status', 1)->get()
        ];
        return view('backend.products.create', compact('datas'));
    }

    public function generateSKU()
    {
        $lastRecord = Products::latest()->first();
        do {
            $timestamp = Carbon::now()->timestamp; // Get the current timestamp
            $randomString = Str::upper(Str::random(9)); // Generate 5 random uppercase letters
            $newSKU = $randomString . substr($timestamp, 0, 9); // Combine random string and timestamp
        } while ($lastRecord && $lastRecord->sku === $newSKU); // Check against the last record

        return $newSKU;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
