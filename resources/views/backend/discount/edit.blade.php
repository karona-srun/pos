@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
    <form action="{{ url('discount', $datas['data']->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="row justify-content-center mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $datas['title'] }}
                        <div class="card-tools"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                Save</button> <a href="{{ url('discount') }}" class="btn btn-default"><i
                                    class="fas fa-angle-left"></i> Back</a> </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <div class="card-body table-responsive p-0  mb-5">
                            <div class="row mx-3">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Name <small class="text-red">*</small> </label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ $datas['data']->name ?? old('name') }}">
                                        @error('name')
                                            <small class="error text-red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Status <small class="text-red">*</small> </label>
                                        <select name="status" class="form-control select2">
                                            <option {{ old('status') === "N/A" ? 'selected' : '' }} value="N/A">Choice Status</option>
                                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Draft</option>
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Publish</option>
                                        </select>
                                        @error('status')
                                            <small class="error text-red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Discount Percent <small class="text-red">*</small> </label>
                                        <input type="text" step="any" name="discount_percent" class="form-control" placeholder="Enter discount percent" value="{{ $datas['data']->discount_percent ?? old('discount_percent') }}">
                                        @error('discount_percent')
                                            <small class="error text-red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <textarea name="remark" class="form-control" placeholder="Enter remark">{{ $datas['data']->remark ?? old('remark') }}</textarea>
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
