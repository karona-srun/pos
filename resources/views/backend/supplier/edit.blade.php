@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
    <form action="{{ url('suppliers',$datas['data']->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="row justify-content-center mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $datas['title'] }}
                        <div class="card-tools"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                Save</button> <a href="{{ url('suppliers') }}" class="btn btn-default"><i
                                    class="fas fa-angle-left"></i> Back</a> </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <div class="card-body table-responsive p-0  mb-5">
                            <div class="row mx-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Company Name <small class="text-red">*</small> </label>
                                        <input type="text" name="company_name" class="form-control" placeholder="Enter company name" value="{{ $datas['data']->company_name ?? old('company_name') }}">
                                        @error('company_name')
                                            <small class="error text-red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Contact Name <small class="text-red">*</small> </label>
                                        <input type="text" name="contact_name" class="form-control" placeholder="Enter contact name" value="{{ $datas['data']->contact_name ?? old('contact_name') }}">
                                        @error('contact_name')
                                            <small class="error text-red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-3">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Contact Job Title </label>
                                        <input type="text" name="job_title" class="form-control" placeholder="Enter contact job title" value="{{ $datas['data']->contact_job_title ?? old('job_title') }}">
                                        @error('job_title')
                                            <small class="error text-red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Phone Office </label>
                                        <input type="text" name="phone_office" class="form-control" placeholder="Enter phone office" value="{{ $datas['data']->phone_office ?? old('phone_office') }}">
                                        @error('phone_office')
                                            <small class="error text-red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Phone Mobile </label>
                                        <input type="text" name="phone_mobile" class="form-control" placeholder="Enter phone mobile" value="{{ $datas['data']->phone_mobile ?? old('phone_mobile') }}">
                                        @error('phone_mobile')
                                            <small class="error text-red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" placeholder="Enter address">{{ $datas['data']->address ?? old('address') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
