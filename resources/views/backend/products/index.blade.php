@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $datas['title'] }}
                    <div class="card-tools"> <a href="{{ url('products/create') }}" class="btn btn-primary"> <i
                                class="fas fa-plus"></i> Create New</a> </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <div class="row m-3">
                        <div class="col-4">
                            <form action="{{ route('products.index') }}" method="GET" class="mb-3">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Search by Name or Status...">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                                    </div>
                                  </div>
                            </form>
                        </div>
                    </div>
                    <div class="row m-3 mb-5">
                        <div class="col-12">
                            <div class="">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-head-fixed text-nowrap" id="product-types-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>SKU</th>
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Type</th>
                                                <th>Inventory</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-data">
                                            @forelse ($products as $i => $item)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td><span
                                                            class="badge {{ $item->status == 0 ? 'badge-danger' : 'badge-success' }}">
                                                            {{ $item->status === 0 ? 'Draft' : 'Publish' }} </span></td>
                                                    <td class="text-break text-wrap" style="width: 30% !important">
                                                        {{ Str::limit(strip_tags($item->remark), 60) }}
                                                        @if (strlen(strip_tags($item->remark)) > 60)
                                                            <a href="{{ url('product-types', $item) }}" class="btn btn-sm">
                                                                <span class="badge badge-light">Read More</span></a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">{{ $item->creator->name ?? " " }}</span><br>
                                                        <small>{{ $item->created_at }}</small>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge badge-info">{{ $item->updator->name ?? " " }}</span><br>
                                                        <small>{{ $item->updated_at }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="margin">
                                                            <a href="{{ url('product-types', $item->id) }}"
                                                                class="btn btn-sm btn-default"><i class="fas fa-eye"></i></a>
                                                            <a href="{{ url('product-types/' . $item->id . '/edit') }}"
                                                                class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                            <a class="btn btn-sm btn-danger" href="{{ route('logout') }}"
                                                                onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                                                <i class=" fas fa-trash"></i>
                                                            </a>
                                                            <form id="delete-form"
                                                                action="{{ url('product-types/' . $item->id) }}"
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
                                        {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
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
@section('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection