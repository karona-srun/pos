@extends('layouts.app')

@section('title', $datas['title'])
@section('content')
    <form action="{{ url('products') }}" method="post">
        @csrf
        <div class="row justify-content-center mb-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">{{ $datas['title'] }}
                        <div class="card-tools"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                Save</button> <a href="{{ url('product-types') }}" class="btn btn-default"><i
                                    class="fas fa-angle-left"></i> Back</a>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="card-body table-responsive p-0 mb-5">
                            <div class="row mx-3">
                                <div class="col-sm-3 justify-center align-items-center">
                                    <button type="button" class="btn btn-primary" id="buttonFilePhoto" style="width:210px"><i class="fas fa-images"></i> Choice
                                        Product Photo</button>
                                    <input type="file" name="image" class="image" accept="image/*"
                                        style="display: none">
                                    <img src="{{ asset('dist/img/placeholder.png') }}" id="previewHolder"
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
                                    <div class="row mx-3">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Type <small class="text-red">*</small> </label>
                                                <select name="status" class="form-control select2">
                                                    <option {{ old('status') === 'N/A' ? 'selected' : '' }} value="N/A">
                                                        Choice type</option>
                                                    @foreach ($datas['product_type'] as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                    <small class="error text-red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Inventory <small class="text-red">*</small> </label>
                                                <select name="status" class="form-control select2bs4">
                                                    <option {{ old('status') === 'N/A' ? 'selected' : '' }} value="N/A">
                                                        Choice type</option>
                                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Draft
                                                    </option>
                                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>
                                                        Publish</option>
                                                </select>
                                                @error('status')
                                                    <small class="error text-red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Name <small class="text-red">*</small> </label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter name" value="{{ old('name') }}">
                                                @error('name')
                                                    <small class="error text-red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Price <small class="text-red">*</small> </label>
                                                <input type="number" step="any" name="sku" class="form-control"
                                                    placeholder="Enter price" value="{{ old('price') }}">
                                                @error('price')
                                                    <small class="error text-red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Sale Price <small class="text-red">*</small> </label>
                                                <input type="number" step="any" name="sku" class="form-control"
                                                    placeholder="Enter price" value="{{ old('price') }}">
                                                @error('price')
                                                    <small class="error text-red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Discount <small class="text-red">*</small> </label>
                                                <select name="status" class="form-control select2">
                                                    <option {{ old('status') === 'N/A' ? 'selected' : '' }}
                                                        value="N/A">
                                                        Choice discount</option>
                                                    @foreach ($datas['discount'] as $discount)
                                                        <option value="{{ $discount->id }}">{{ $discount->name }} -
                                                            {{ $discount->discount_percent }}%</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                    <small class="error text-red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Remark</label>
                                                <textarea name="remark" class="form-control" placeholder="Enter remark">{{ old('remark') }}</textarea>
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
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal({backdrop: 'static', keyboard: false},'show');
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
                    // var base64data = reader.result;
                    // $.ajax({
                    //     type: "POST",
                    //     dataType: "json",
                    //     url: "crop-image-upload",
                    //     data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
                    //     success: function(data){
                    //         console.log(data);
                    //         $modal.modal('hide');
                    //         alert("Crop image successfully uploaded");
                    //     }
                    //   });
                    $modal.modal('hide');
                }
            });
        })
    </script>
@endsection
