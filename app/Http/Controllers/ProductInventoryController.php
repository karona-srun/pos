<?php

namespace App\Http\Controllers;

use App\Models\ProductInventory;
use Illuminate\Http\Request;

class ProductInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = [
            'title' => 'Custmer',
        ];
        return view('backend.inventory.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductInventory $productInventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductInventory $productInventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductInventory $productInventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductInventory $productInventory)
    {
        //
    }
}
