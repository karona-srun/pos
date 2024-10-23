<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $suppliers = Supplier::when($search, function($query) use ($search) {
            return $query->where('company_name', 'like', '%' . $search . '%')
                         ->orWhere('contact_name', 'like', '%' . $search . '%')
                         ->orWhere('address', 'like', '%' . $search . '%');
        })->paginate(10);

        $datas = [
            'title' => 'Suppliers List',
            'data' => $suppliers
        ];

        return view('backend.supplier.index', ['datas' => $datas,'suppliers' => $suppliers, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = [
            'title' => 'Create Suppliers',
        ];
        return view('backend.supplier.create', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'job_title' => 'required',
            'phone_office' => 'required|unique:suppliers|min:9',
            'phone_mobile' => 'required|unique:suppliers|min:9',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $suppliers = new Supplier();
        $suppliers->company_name = $request->company_name;
        $suppliers->contact_name = $request->contact_name;
        $suppliers->contact_job_title = $request->job_title;
        $suppliers->phone_office = $request->phone_office;
        $suppliers->phone_mobile = $request->phone_mobile;
        $suppliers->address = $request->address;
        $suppliers->created_by = Auth::user()->id;
        $suppliers->updated_by = Auth::user()->id;
        $suppliers->save();

        return redirect('suppliers')->with('success', 'The '.$suppliers->company_name.' has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $datas = [
            'title' => 'Update Suppliers',
            'data' => Supplier::find($id)
        ];
        return view('backend.supplier.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'job_title' => 'required',
            'phone_office' => [
            'required',
            'min:9',
                Rule::unique('suppliers')->ignore($id) // Ignore the current record's ID
            ],
            'phone_mobile' => [
            'required',
            'min:9',
                Rule::unique('suppliers')->ignore($id) // Ignore the current record's ID
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $suppliers = Supplier::find($id);
        $suppliers->company_name = $request->company_name;
        $suppliers->contact_name = $request->contact_name;
        $suppliers->contact_job_title = $request->job_title;
        $suppliers->phone_office = $request->phone_office;
        $suppliers->phone_mobile = $request->phone_mobile;
        $suppliers->address = $request->address;
        $suppliers->updated_by = Auth::user()->id;
        $suppliers->save();

        return redirect('suppliers')->with('success', 'The '.$suppliers->company_name.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Supplier::findOrFail($id);

        $data->delete();
        return redirect('suppliers')->with('success', 'This '.$data->company_name. ' has been deleted successfully!');

    }
}
