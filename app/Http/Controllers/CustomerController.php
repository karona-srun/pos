<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $customer = Customer::get();

        $datas = [
            'title' => 'Customer List',
            'data' => $customer
        ];

        return view('backend.customer.index', ['datas' => $datas,'customer' => $customer, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = [
            'title' => 'Create Customer',
        ];
        return view('backend.customer.create', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required|unique:customers|min:9',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone_number = $request->phone_number;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->created_by = Auth::user()->id;
        $customer->updated_by = Auth::user()->id;
        $customer->save();

        return redirect('customer')->with('success', 'The '.$customer->name.' has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $datas = [
            'title' => 'Update Customer',
            'data' => Customer::findOrFail($id)
        ];
        return view('backend.customer.show', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $datas = [
            'title' => 'Update Customer',
            'data' => Customer::find($id)
        ];
        return view('backend.customer.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => [
            'required',
            'max:255',
                Rule::unique('customers')->ignore($id) // Ignore the current record's ID
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->phone_number = $request->phone_number;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->updated_by = Auth::user()->id;
        $customer->save();

        return redirect('customer')->with('success', 'The '.$customer->name.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Customer::findOrFail($id);

        $data->delete();
        return redirect('customer')->with('success', 'This '.$data->name. ' has been deleted successfully!');

    }
}
