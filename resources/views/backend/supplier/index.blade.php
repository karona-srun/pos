@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $datas['title'] }}
                    <div class="card-tools"> <a href="{{ url('suppliers/create') }}" class="btn btn-primary"> <i
                                class="fas fa-plus"></i> Create New</a> </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <div class="row m-3 mb-5">
                        <div class="col-12">
                            <div class="">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-head-fixed text-nowrap dataTable1" id="product-types-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Company Name</th>
                                                <th>Contact Name</th>
                                                <th>Phone Office</th>
                                                <th>Phone Mobile</th>
                                                <th>Created By</th>
                                                <th>Updated By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-data">
                                            @forelse ($suppliers as $i => $item)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $item->company_name }}</td>
                                                    <td>{{ $item->contact_name }}</td>
                                                    <td>{{ $item->phone_office }}</td>
                                                    <td>{{ $item->phone_mobile }}</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-info">{{ $item->creator->name ?? " " }}</span><br>
                                                        <small>{{ $item->created_at }}</small>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge badge-info">{{ $item->updator->name ?? " " }}</span><br>
                                                        <small>{{ $item->updated_at }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="margin">
                                                            <a href="{{ url('suppliers/' . $item->id . '/edit') }}"
                                                                class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                            <a class="btn btn-sm btn-danger" href="#"
                                                                onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                                                <i class=" fas fa-trash"></i>
                                                            </a>
                                                            <form id="delete-form"
                                                                action="{{ url('suppliers/' . $item->id) }}"
                                                                method="POST" class="d-none">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No records found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        {!! $suppliers->withQueryString()->links('pagination::bootstrap-5') !!}
                                    </div>
                                </div>

                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
