@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $datas['title'] }}
                <div class="card-tools">
                    <a href="{{ url('product-types/'. $datas['data']->id.'/edit') }}" class="btn btn-warning"><i class="fas fa-edit"></i>
                        Edit</a>
                        <a href="{{ url('product-types') }}" class="btn btn-default"><i
                            class="fas fa-angle-left"></i> Back</a> </div>
            </div>
            <div class="card-body table-responsive p-0">
                <div class="card-body table-responsive p-0  mb-5">
                    <div class="row mx-3">
                        <dt class="col-sm-4">NAME</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->name }}</dd>
                        <dt class="col-sm-4">STATUS</dt>
                        <dd class="col-sm-8">: <span class="badge {{ $datas['data']->status == 0 ? 'badge-danger' : 'badge-success' }}">
                            {{ $datas['data']->status === 0 ? 'Draft' : 'Publish' }} </span></dd>
                        <dt class="col-sm-4">REMARK</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->remark }}</dd>
                        <dt class="col-sm-4">CREATOR</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->creator->name ?? ""}}</dd>
                        <dt class="col-sm-4">CREADTED AT</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->created_at }}</dd>
                        <dt class="col-sm-4">UPDATOR</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->updator->name ?? ""}}</dd>
                        <dt class="col-sm-4">UPDATED AT</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->updated_at }}</dd>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
