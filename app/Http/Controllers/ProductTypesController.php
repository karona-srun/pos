<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productTypes = ProductTypes::get();

        $datas = [
            'title' => 'Product Types List',
            'data' => $productTypes
        ];

        return view('backend.product_types.index', ['datas' => $datas,'productTypes' => $productTypes]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->get('query');
        $data = ProductTypes::where('name', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('remark', 'LIKE', "%{$searchTerm}%")
                            ->get();
        return response()->json($data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = [
            'title' => 'Create Product Types'
        ];
        return view('backend.product_types.create', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:product_types|max:255',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $productTypes = new ProductTypes();
        $productTypes->name = $request->name;
        $productTypes->status = $request->status;
        $productTypes->remark = $request->remark;
        $productTypes->created_by = Auth::user()->id;
        $productTypes->updated_by = Auth::user()->id;
        $productTypes->save();

        return redirect('payment-type')->with('success', 'The '.$productTypes->name.' has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $datas = [
            'title' => 'Show Product Types',
            'data' => ProductTypes::findOrFail($id)
        ];
        return view('backend.product_types.show', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $datas = [
            'title' => 'Update Product Types',
            'data' => ProductTypes::findOrFail($id)
        ];
        return view('backend.product_types.edit', compact('datas'));
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
                Rule::unique('product_types')->ignore($id) // Ignore the current record's ID
            ],
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $productTypes = ProductTypes::findOrFail($id);
        $productTypes->name = $request->name;
        $productTypes->status = $request->status;
        $productTypes->remark = $request->remark;
        $productTypes->updated_by = Auth::user()->id;
        $productTypes->save();

        return redirect('payment-type')->with('success', 'The '.$productTypes->name.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Products::where('product_type_id')->first();
        $data = ProductTypes::findOrFail($id);
        if(!$product){
            $data->delete();
            return redirect('product-types')->with('success', 'This '.$data->name. ' has been deleted successfully!');
        }else{
            return redirect('product-types')->with('success', $data->name.' could not be deleted because this record is still in use!');
        }
    }
}
