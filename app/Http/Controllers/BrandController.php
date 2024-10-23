<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brand::orderBY('created_at')->get();
        $datas = [
            'title' => 'Brands List',
            'brand' => $brand
        ];
        return view('backend.brand.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = [
            'title' => 'Create Brands',
        ];
        return view('backend.brand.create', ['datas' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->remark = $request->remark;
        $brand->status = $request->status ?? 1;
        $brand->created_by = Auth::user()->id;
        $brand->updated_by = Auth::user()->id;
        $brand->save();

        return redirect('brands')->with('success', 'The '.$brand->name.' has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $datas = [
            'title' => 'Update Brands',
            'brand' => Brand::find($id)
        ];
        return view('backend.brand.edit', ['datas' => $datas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->remark = $request->remark;
        $brand->status = $request->status ?? 1;
        $brand->updated_by = Auth::user()->id;
        $brand->save();

        return redirect('brands')->with('success', 'The '.$brand->name.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect('brands')->with('success','The '. $brand->name.' has been deleted successfully!');

    }
}
