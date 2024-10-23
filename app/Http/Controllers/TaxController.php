<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tax = Tax::orderBY('created_at')->get();
        $datas = [
            'title' => 'Tax List',
            'data' => $tax
        ];
        return view('backend.tax.index', ['datas' => $datas,'tax' => $tax ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = [
            'title' => 'Create Taxes',
        ];
        return view('backend.tax.create', ['datas' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'tax' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $tax = new Tax();
        $tax->name = $request->name;
        $tax->tax = $request->tax;
        $tax->status = $request->status ?? 1;
        $tax->created_by = Auth::user()->id;
        $tax->updated_by = Auth::user()->id;
        $tax->save();

        return redirect('tax')->with('success', 'The '.$tax->name.' has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tax = Tax::find($id);
        $datas = [
            'title' => 'Update Taxes',
        ];
        return view('backend.payment_type.edit', ['datas' => $datas, 'tax' => $tax]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'tax' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $tax = Tax::find($id);
        $tax->name = $request->name;
        $tax->tax = $request->tax;
        $tax->status = $request->status ?? 1;
        $tax->updated_by = Auth::user()->id;
        $tax->save();

        return redirect('tax')->with('success', 'The '.$tax->name.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tax = Tax::find($id);
        $tax->delete();

        // Restore the record
        // $tax = Tax::withTrashed()->find($id);
        // $tax->restore();

        return redirect('tax')->with('success', 'The '.$tax->name.' has been deleted successfully!');
    }
}
