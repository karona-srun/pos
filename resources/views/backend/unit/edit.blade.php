@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
    <form action="{{ url('unit', $unit->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="row justify-content-center mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $datas['title'] }}
                        <div class="card-tools"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                Save</button> <a href="{{ url('unit') }}" class="btn btn-default"><i
                                    class="fas fa-angle-left"></i> Back</a> </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <div class="card-body table-responsive p-0  mb-5">
                            <div class="row mx-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Unit Name <small class="text-red">*</small> </label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ $unit->name ?? old('name') }}">
                                        @error('name')
                                            <small class="error text-red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status <small class="text-red">*</small> </label>
                                        <select name="status" class="form-control select2">
                                            <option value="1" {{ $unit->status == 1 ? 'selected':'' }}>Active</option>
                                            <option value="0"  {{ $unit->status == 0 ? 'selected':'' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Remark <small class="text-red">*</small> </label>
                                        <textarea name="remark" id="" rows="3" class=" form-control" placeholder="Enter remark">{{ $unit->remark ?? old('remark') }}</textarea>
                                    </div>
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
