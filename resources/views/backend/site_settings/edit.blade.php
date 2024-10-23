@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
    <form action="{{ url('site', $datas['site']->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row justify-content-center mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $datas['title'] }}
                        <div class="card-tools"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                Update</button> <a href="{{ url('dashboard') }}" class="btn btn-default"><i
                                    class="fas fa-angle-left"></i> Dashboard</a> </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <div class="card-body table-responsive p-0  mb-5">
                            <div class="row mx-3">
                                <div class="col-sm-12">
                                    <h6>Update Site Settings</h6>
                                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                                                href="#custom-content-below-home" role="tab"
                                                aria-controls="custom-content-below-home" aria-selected="true"><i
                                                    class="fas fa-cog"></i> Site</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                                                href="#custom-content-below-profile" role="tab"
                                                aria-controls="custom-content-below-profile" aria-selected="false"><i
                                                    class="fas fa-check-double"></i> Sales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill"
                                                href="#custom-content-below-messages" role="tab"
                                                aria-controls="custom-content-below-messages" aria-selected="false"><i
                                                    class="fas fa-hashtag"></i> Prefixes</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-2" id="custom-content-below-tabContent">
                                        <div class="tab-pane fade show active" id="custom-content-below-home"
                                            role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                            <div class="row mx-3 mt-4">
                                                <div class="col-sm-4 offset-sm-1">
                                                    <div class="form-group">
                                                        <label>Site Name <small class="text-red">*</small> </label>
                                                        <input type="text" name="site_name" class="form-control"
                                                            placeholder="Enter Site Name"
                                                            value="{{ old('site_name') ?? $datas['site']->site_name }}">
                                                        @error('site_name')
                                                            <small class="error text-red">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Timezone <small class="text-red">*</small> </label>
                                                        <select name="timezone" class=" form-control    ">
                                                            <option value="{{ $datas['site']->timezone }}">
                                                                {{ $datas['site']->timezone }}</option>
                                                        </select>
                                                        @error('timezone')
                                                            <small class="error text-red">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Date Format<small class="text-red">*</small> </label>
                                                        <select name="date_format" class=" form-control select2">
                                                            <option value="dmY"
                                                                {{ $datas['site']->date_format === 'dmY' ? 'selected' : '' }}>
                                                                dd-mm-yyyy</option>
                                                            <option value="mdY"
                                                                {{ $datas['site']->date_format === "mdY" ? 'selected' : '' }}>
                                                                mm-dd-yyyy</option>
                                                        </select>
                                                        @error('date_format')
                                                            <small class="error text-red">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Time Format <small class="text-red">*</small> </label>
                                                        <select name="time_format" class=" form-control select2">
                                                            <option value="12"
                                                                {{ $datas['site']->time_format == '12' ? 'selected' : '' }}>
                                                                12 Hours</option>
                                                            <option value="24"
                                                                {{ $datas['site']->time_format == '24' ? 'selected' : '' }}>
                                                                24 Hours</option>
                                                        </select>
                                                        @error('time_format')
                                                            <small class="error text-red">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Currency <small class="text-red">*</small> </label>
                                                        <select name="currency" class=" form-control select2">
                                                            @foreach ($datas['currency'] as $cur)
                                                                <option value="{{ $cur->signal }}"
                                                                    {{ $cur->signal === $datas['site']->currency ? 'selected' : '' }}>
                                                                    {{ $cur->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('dateformat')
                                                            <small class="error text-red">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 offset-sm-2">
                                                    <div class="form-group">
                                                        <label><i class="fas fa-language"></i> Lannguage </label>
                                                        <select name="language" class=" form-control select2">
                                                            <option value="en">English</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Site Logo </label>
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-primary"
                                                                id="btnSignature">Choice Logo</button>
                                                            <br><small class="text-red">Max Width/Height: 512px * 512px &
                                                                Size: 1024kb</small>
                                                            <input type="file" name="site_logo" id="logoUpload"
                                                                accept=".png, .jpg, .jpeg" style="display: none" />
                                                            <div class="mt-3 m-3">
                                                                <div id="siteLogoPreview" class="img-thumbnail"
                                                                    style=" {{ $datas['site']->site_logo ? 'background-image: url(' . Storage::disk('logo')->url($datas['site']->site_logo) . ')' : 'background-image: url(dist/img/signature.png);' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
                                            aria-labelledby="custom-content-below-profile-tab">
                                            <div class="row mx-3 mt-4">
                                                <div class="col-sm-10 offset-sm-1">
                                                    <div class="form-group">
                                                        <label>Sales Invoice Footer Text</label>
                                                        <textarea name="sale_invoice_footer_text" class="form-control" rows="3">{{ $datas['site']->sale_invoice_footer_text }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Invoice Terms and Conditions</label>
                                                        <textarea name="invoice_terms_and_condition" class="form-control" rows="5">{{ $datas['site']->invoice_terms_and_condition }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel"
                                            aria-labelledby="custom-content-below-messages-tab">
                                            <div class="row mx-3 mt-4">
                                                <div class="col-sm-3 offset-sm-1">
                                                    <div class="form-group">
                                                        <label>Product Category <small class="text-red">*</small></label>
                                                        <input type="text" name="prefix_product_category"
                                                            class="form-control"
                                                            value="{{ $datas['site']->prefix_product_category }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Supplier <small class="text-red">*</small></label>
                                                        <input type="text" name="prefix_supplier" class="form-control"
                                                            value="{{ $datas['site']->prefix_supplier }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Purchase Return <small class="text-red">*</small></label>
                                                        <input type="text" name="prefix_purchase_return"
                                                            class="form-control"
                                                            value="{{ $datas['site']->prefix_purchase_return }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 offset-sm-1">
                                                    <div class="form-group">
                                                        <label>Sale <small class="text-red">*</small></label>
                                                        <input type="text" name="prefix_sale" class="form-control"
                                                            value="{{ $datas['site']->prefix_sale }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Expense <small class="text-red">*</small></label>
                                                        <input type="text" name="prefix_expense" class="form-control"
                                                            value="{{ $datas['site']->prefix_expense }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Products <small class="text-red">*</small></label>
                                                        <input type="text" name="prefix_product" class="form-control"
                                                            value="{{ $datas['site']->prefix_product }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 offset-sm-1">
                                                    <div class="form-group">
                                                        <label>Purchase <small class="text-red">*</small></label>
                                                        <input type="text" name="prefix_purchase" class="form-control"
                                                            value="{{ $datas['site']->prefix_purchase }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Customer <small class="text-red">*</small></label>
                                                        <input type="text" name="prefix_customer" class="form-control"
                                                            value="{{ $datas['site']->prefix_customer }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sale Return <small class="text-red">*</small></label>
                                                        <input type="text" name="prefix_sale_return"
                                                            class="form-control"
                                                            value="{{ $datas['site']->prefix_sale_return }}">
                                                    </div>
                                                </div>
                                            </div>
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
