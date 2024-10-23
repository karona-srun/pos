@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
    <form action="{{ url('currency') }}" method="post">
        @csrf
        <div class="row justify-content-center mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $datas['title'] }}
                        <div class="card-tools"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                Save</button> <a href="{{ url('currency') }}" class="btn btn-default"><i
                                    class="fas fa-angle-left"></i> Back</a> </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <div class="card-body table-responsive p-0  mb-5">
                            <div class="row mx-3">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Currency <small class="text-red">*</small> </label>
                                        <input type="text" name="currency" class="form-control" placeholder="Enter currency" value="{{ old('currency') }}">
                                        @error('currency')
                                            <small class="error text-red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Signal <small class="text-red">*</small> </label>
                                        <input type="text" name="signal" class="form-control" placeholder="Enter signal" value="{{ old('signal') }}">
                                        @error('signal')
                                            <small class="error text-red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Status <small class="text-red">*</small> </label>
                                        <select name="status" class="form-control select2">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Remark </label>
                                        <textarea name="remark" id="" rows="3" class=" form-control" placeholder="Enter remark"></textarea>
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
