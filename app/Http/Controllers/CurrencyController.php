<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currency = Currency::orderBY('created_at')->get();
        $datas = [
            'title' => 'Currency List',
            'data' => $currency
        ];
        return view('backend.currency.index', ['datas' => $datas,'currency' => $currency ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = [
            'title' => 'Create Currency',
        ];
        return view('backend.currency.create', ['datas' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'currency' => 'required',
            'signal' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $currency = new Currency();
        $currency->name = $request->currency;
        $currency->signal = $request->signal;
        $currency->remark = $request->remark;
        $currency->status = $request->status ?? 1;
        $currency->created_by = Auth::user()->id;
        $currency->updated_by = Auth::user()->id;
        $currency->save();

        return redirect('currency')->with('success', 'The '.$currency->name.' has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $currency = Currency::find($id);
        $datas = [
            'title' => 'Update Currency',
        ];
        return view('backend.currency.edit', ['datas' => $datas, 'currency' => $currency]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'signal' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $currency = Currency::find($id);
        $currency->name = $request->name;
        $currency->signal = $request->signal;
        $currency->remark = $request->remark;
        $currency->status = $request->status ?? 1;
        $currency->updated_by = Auth::user()->id;
        $currency->save();

        return redirect('currency')->with('success', 'The '.$currency->name.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $currency = Currency::find($id);
        $currency->delete();

        // Restore the record
        // $tax = Tax::withTrashed()->find($id);
        // $tax->restore();

        return redirect('currency')->with('success', 'The '.$currency->name.' has been deleted successfully!');
    }
}
