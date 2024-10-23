<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unit = Unit::orderBY('created_at')->get();
        $datas = [
            'title' => 'Unit List',
            'data' => $unit
        ];
        return view('backend.unit.index', ['datas' => $datas,'unit' => $unit ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = [
            'title' => 'Create Unit',
        ];
        return view('backend.unit.create', ['datas' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $unit = new Unit();
        $unit->name = $request->name;
        $unit->remark = $request->remark;
        $unit->status = $request->status ?? 1;
        $unit->created_at = Auth::user()->id;
        $unit->updated_by = Auth::user()->id;
        $unit->save();

        return redirect('unit')->with('success', 'The '.$unit->name.' has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        $datas = [
            'title' => 'Update Unit',
        ];
        return view('backend.unit.edit', ['datas' => $datas, 'unit' => $unit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $unit = Unit::find($id);
        $unit->name = $request->name;
        $unit->remark = $request->remark;
        $unit->status = $request->status ?? 1;
        $unit->updated_by = Auth::user()->id;
        $unit->save();

        return redirect('unit')->with('success', 'The '.$unit->name.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();

        // Restore the record
        // $unit = Unit::withTrashed()->find($id);
        // $unit->restore();
        return redirect('unit')->with('success', 'The '. $unit->name.' has been deleted successfully!');
    }
}
