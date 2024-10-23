<?php

namespace App\Http\Controllers;

use App\Models\PaymentTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pay = PaymentTypes::orderBY('created_at')->get();
        $datas = [
            'title' => 'Payment Type List',
            'data' => $pay
        ];
        return view('backend.payment_type.index', compact('datas','pay' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = [
            'title' => 'Create Payment Type',
        ];
        return view('backend.payment_type.create', ['datas' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'remark' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $pay = new PaymentTypes();
        $pay->name = $request->name;
        $pay->remark = $request->remark;
        $pay->status = $request->status ?? 1;
        $pay->created_by = Auth::user()->id;
        $pay->updated_by = Auth::user()->id;
        $pay->save();

        return redirect('payment-type')->with('success', 'The '.$pay->name.' has been created successfully!');
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
        $pay = PaymentTypes::find($id);
        $datas = [
            'title' => 'Update Payment Type',
        ];
        return view('backend.payment_type.edit', ['datas' => $datas, 'pay' => $pay]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'remark' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $pay = PaymentTypes::find($id);
        $pay->name = $request->name;
        $pay->remark = $request->remark;
        $pay->status = $request->status ?? 1;
        $pay->updated_by = Auth::user()->id;
        $pay->save();

        return redirect('payment-type')->with('success', 'The '.$pay->name.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pay = PaymentTypes::find($id);
        $pay->delete();

        // Restore the record
        // $tax = Tax::withTrashed()->find($id);
        // $tax->restore();

        return redirect('payment-type')->with('success', 'The '.$pay->name.' has been deleted successfully!');
    }
}
