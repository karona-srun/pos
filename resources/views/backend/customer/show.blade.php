@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $datas['title'] }}
                <div class="card-tools">
                    <a href="{{ url('customer/'. $datas['data']->id.'/edit') }}" class="btn btn-warning"><i class="fas fa-edit"></i>
                        Edit</a>
                        <a href="{{ url('customer') }}" class="btn btn-default"><i
                            class="fas fa-angle-left"></i> Back</a> </div>
            </div>
            <div class="card-body table-responsive p-0">
                <div class="card-body table-responsive p-0  mb-5">
                    <dl class="row mx-3">
                        <dt class="col-sm-4">NAME</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->name }}</dd>
                        <dt class="col-sm-4">PHONE</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->phone }}</dd>
                        <dt class="col-sm-4">EMAIL</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->email }}</dd>
                        <dt class="col-sm-4">ADDRESS</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->address }}</dd>
                        <dt class="col-sm-4">CREADTOR</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->creator->name ?? "" }}</dd>
                        <dt class="col-sm-4">CREADTED AT</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->created_at }}</dd>
                        <dt class="col-sm-4">UPDATOR</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->updator->name ?? ""}}</dd>
                        <dt class="col-sm-4">UPDATED AT</dt>
                        <dd class="col-sm-8">: {{ $datas['data']->updated_at }}</dd>
                      </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
