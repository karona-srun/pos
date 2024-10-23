<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = [
            'title' => 'Company Profile',
            'sub-title' => 'Add / Update Company Profile',
            'company' => CompanyProfile::first()
        ];
        return view('backend.company_profile.edit', compact('datas'));
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
    public function show(CompanyProfile $companyProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyProfile $companyProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|max:255',
            'mobile' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->hasFile('signature_image')) {
            $signature_image = $request->file('signature_image')->store(options: 'signature');
        }

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store(options: 'logo');
        }

        $companyProfile = CompanyProfile::find($id);
        $companyProfile->company_name = $request->company_name;
        $companyProfile->mobile = $request->mobile;
        $companyProfile->email = $request->email;
        $companyProfile->phone = $request->phone;
        $companyProfile->gst_number = $request->gst_number;
        $companyProfile->vat_number = $request->vat_number;
        $companyProfile->pan_number = $request->pan_number;
        $companyProfile->website = $request->website;
        $companyProfile->show_signature = $request->show_signature ?? false;
        $companyProfile->signature_image = $signature_image ?? null;
        $companyProfile->country = $request->country;
        $companyProfile->state = $request->state;
        $companyProfile->city = $request->city;
        $companyProfile->postcode = $request->postcode;
        $companyProfile->address = $request->address;
        $companyProfile->company_logo = $logo ?? null;
        $companyProfile->save();

        return redirect('company')->with('success', 'The '.$companyProfile->company_name.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyProfile $companyProfile)
    {
        //
    }
}
