@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
    <form action="{{ url('company', $datas['company']->id) }}" method="post" enctype="multipart/form-data">
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
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6 class="title-inline">Company Info:</h6>
                                    <hr class="mx-3">
                                </div>
                            </div>
                            <div class="row mx-3 mt-4">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" id="btnSignature">Choice Signature</button>
                                        <br><small class="text-red">Max Width/Height: 100px * 220px & Size: 1024kb</small>
                                        <input type="file" name="signature_image" id="logoUpload" accept=".png, .jpg, .jpeg" style="display: none" />
                                        <div class="mt-3 img-thumbnail m-3">
                                            <div id="logoPreview" style=" {{ $datas['company']->signature_image ? 'background-image: url('.Storage::disk('signature')->url($datas['company']->signature_image).')' : 'background-image: url(dist/img/signature.png);' }}"></div>
                                        </div>
                                    </div>

                                    <div class="icheck-primary">
                                        <input type="checkbox" name="show_signature" id="show_signature"
                                            value="{{ $datas['company']->show_signature }}" {{ $datas['company']->show_signature == 1 ? 'checked' : '' }}>
                                        <label for="show_signature">
                                            Show Signature on Invoice
                                        </label>
                                        <span class=" badge badge-success">Only available in Sales Invoice </span>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Company Name <small class="text-red">*</small> </label>
                                                <input type="text" name="company_name" class="form-control"
                                                    placeholder="Enter company name"
                                                    value="{{ old('company_name') ?? $datas['company']->company_name }}">
                                                @error('company_name')
                                                    <small class="error text-red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Mobile <small class="text-red">*</small> </label>
                                                <input type="text" name="mobile" class="form-control"
                                                    placeholder="Enter mobile"
                                                    value="{{ old('mobile') ?? $datas['company']->mobile }}">
                                                @error('mobile')
                                                    <small class="error text-red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email <small class="text-red">*</small> </label>
                                                <input type="text" name="email" class="form-control"
                                                    placeholder="Enter email"
                                                    value="{{ old('email') ?? $datas['company']->email }}">
                                                @error('email')
                                                    <small class="error text-red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" name="phone" class="form-control"
                                                    placeholder="Enter phone"
                                                    value="{{ old('phone') ?? $datas['company']->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>GST Number</label>
                                                <input type="text" name="gst_number" class="form-control"
                                                    placeholder="Enter GST Number"
                                                    value="{{ old('gst_number') ?? $datas['company']->gst_number }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>VAT Number</label>
                                                <input type="text" name="vat_number" class="form-control"
                                                    placeholder="Enter VAT Number"
                                                    value="{{ old('vat_number') ?? $datas['company']->vat_number }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>PAN Number</label>
                                                <input type="text" name="pan_number" class="form-control"
                                                    placeholder="Enter PAN Number"
                                                    value="{{ old('pan_number') ?? $datas['company']->pan_number }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Website</label>
                                                <input type="text" name="website" class="form-control"
                                                    placeholder="Enter Website"
                                                    value="{{ old('website') ?? $datas['company']->website }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6 class="title-inline">Company Location:</h6>
                                    <hr class="mx-3">
                                </div>
                            </div>
                            <div class="row mx-3 mt-4">
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-primary" id="buttonFilePhoto"
                                        style="width:210px"><i class="fas fa-images"></i> Choice
                                        Logo</button>
                                    <input type="file" name="logo" class="image" accept="image/*"
                                        style="display: none">
                                    <img src="{{ $datas['company']->company_logo ? Storage::disk('logo')->url($datas['company']->company_logo) : asset('dist/img/placeholder.png') }}" id="previewHolder"
                                        class="mt-3 img-thumbnail img-size-64"
                                        style="width: 210px !important; height: 210px !important">

                                    <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                        aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">Crop Photo</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="img-container">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <img id="image"
                                                                    src="https://avatars0.githubusercontent.com/u/3456749">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="preview"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary"
                                                        id="crop">Crop</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" name="country" class="form-control"
                                                    placeholder="Enter Country"
                                                    value="{{ old('country') ?? $datas['company']->country }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>State</label>
                                                <input type="text" name="state" class="form-control"
                                                    placeholder="Enter State"
                                                    value="{{ old('state') ?? $datas['company']->state }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" name="city" class="form-control"
                                                    placeholder="Enter City"
                                                    value="{{ old('city') ?? $datas['company']->city }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Postcode</label>
                                                <input type="text" name="postcode" class="form-control"
                                                    placeholder="Enter Postcode"
                                                    value="{{ old('postcode') ?? $datas['company']->postcode }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" class="form-control" rows="3" placeholder="Enter Address">{{ old('address') ?? $datas['company']->address }}</textarea>
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
@section('css')
    <style type="text/css">
        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {

            $("#show_signature").change(function() {
                let chx = $(this)[0].checked ? 1 : 0;
                $("#show_signature").val(chx)
                $("#show_signature").prop('checked', chx);
            });

            function readURL(input, previewId) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(previewId).css('background-image', 'url('+e.target.result +')');
                        $(previewId).hide();
                        $(previewId).fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#btnSignature').click( function() {
                $("#logoUpload").click();
            })

            $("#logoUpload").change(function() {
                readURL(this, '#logoPreview');
            });

            var $modal = $('#modal');
            var image = document.getElementById('image');
            var cropper;

            $("body").on("change", ".image", function(e) {
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    $modal.modal({
                        backdrop: 'static',
                        keyboard: false
                    }, 'show');
                };
                var reader;
                var file;
                var url;
                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            $("#buttonFilePhoto").unbind("click").bind("click", function() {
                $(".image").click();
            });

            $("#crop").click(function() {
                canvas = cropper.getCroppedCanvas({
                    width: 160,
                    height: 160,
                });
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewHolder').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        $modal.modal('hide');
                    }
                });
            })
        });
    </script>
@endsection
