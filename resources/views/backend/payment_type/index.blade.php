@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $datas['title'] }}
                <div class="card-tools"> <a href="{{ url('payment-type/create') }}" class="btn btn-primary"> <i
                            class="fas fa-plus"></i> Create New</a> </div>
            </div>
            <div class="card-body table-responsive p-0">
                <div class="row m-3 mb-5">
                    <div class="col-12">
                        <div class="">
                            <div class="card-body table-responsive p-0">
                                <table class="table dataTable1" id="dataTables1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Payment</th>
                                            <th>Remark</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pay as $i => $item)
                                        <tr>
                                            <td>{{  ++$i }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->remark }}</td>
                                            <td><span class="badge {{ $item->status === 1 ? 'badge-success':'badge-danger' }}"> {{ $item->status == 1 ? 'Active' : 'Inactive' }}</span></td>
                                            @if ($item->name == 'None')
                                            <td>
                                                <button class="btn btn-default">Default</button>
                                            </td>
                                            @else
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown" aria-expanded="false">Action </button>
                                                    <div class="dropdown-menu px-2" role="menu" style="">
                                                      <a class="dropdown-item rounded my-1" href="{{ url('payment-type/'. $item->id.'/edit') }}"> <i class="fas fa-edit "></i> Edit</a>
                                                      <a class="dropdown-item rounded my-1" href="#"
                                                                onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                                                <i class=" fas fa-trash"></i> Delete
                                                            </a>
                                                            <form id="delete-form"
                                                                action="{{ url('payment-type/' . $item->id) }}"
                                                                method="POST" class="d-none">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                    </div>
                                                  </div>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
