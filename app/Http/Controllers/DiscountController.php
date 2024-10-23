<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $discount = Discount::get();
        $datas = [
            'title' => 'Discount List',
            'data' => $discount
        ];

        return view('backend.discount.index', ['datas' => $datas, 'discount' => $discount]);
    }

    public function search()
    {

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = [
            'title' => 'Discount',
        ];

        return view('backend.discount.create', ['datas' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:discounts|max:255',
            'status' => 'required',
            'discount_percent' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $discount = new Discount();
        $discount->name = $request->name;
        $discount->status = $request->status;
        $discount->discount_percent = $request->discount_percent;
        $discount->remark = $request->remark;
        $discount->created_by = Auth::user()->id;
        $discount->updated_by = Auth::user()->id;
        $discount->save();

        return redirect('discount')->with('success', 'The '.$discount->name.' has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $datas = [
            'title' => 'Show Discount',
            'data' => Discount::findOrFail($id)
        ];
        return view('backend.discount.show', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $datas = [
            'title' => 'Update Discount',
            'data' => Discount::findOrFail($id)
        ];
        return view('backend.discount.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
            'required',
            'max:255',
                Rule::unique('discounts')->ignore($id) // Ignore the current record's ID
            ],
            'status' => 'required',
            'discount_percent' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $discount = Discount::find($id);
        $discount->name = $request->name;
        $discount->status = $request->status;
        $discount->discount_percent = $request->discount_percent;
        $discount->remark = $request->remark;
        $discount->updated_by = Auth::user()->id;
        $discount->save();

        return redirect('discount')->with('success', 'The '.$discount->name.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Products::where('product_type_id')->first();
        $data = Discount::findOrFail($id);
        if(!$product){
            $data->delete();
            return redirect('discount')->with('success', 'This '.$data->name. ' has been deleted successfully!');
        }else{
            return redirect('discount')->with('success', $data->name.' could not be deleted because this record is still in use!');
        }
    }
}
