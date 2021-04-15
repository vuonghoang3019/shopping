@extends('admin.admin')

@section('title')
    <title>Add product</title>
@endsection
@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-wrapper">
    @include('layouts.content-header',['name' => 'Product','key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('products.store') }}" method='post' enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                       placeholder="Nhập tên sản phẩm" name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">giá sản phẩm</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                       placeholder="Nhập số luọng sản phẩm" name="price" value="{{ old('price') }}">
                                @error('price')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Số lượng</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                       placeholder="100" name="quantity" min="1" max="1000" value="{{ old('quantity') }}">
                                @error('quantity')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Sale</label>
                                <input type="number" class="form-control" placeholder="10%" name="sale" value="{{ old('sale') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh đại diện</label>
                                <input type="file" class="form-control-file @error('feature_image_path') is-invalid @enderror"
                                       placeholder="Cfeature_image_pathhọn ảnh đại diện"
                                       name="feature_image_path" value="{{ old('feature_image_path ') }}">
                                @error('feature_image_path')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Ảnh chi tiết</label>
                                <input type="file" multiple class="form-control"
                                       placeholder="Chọn ảnh chi tiết"
                                       name="image_path[]" value="{{ old('image_path') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Chọn danh mục</label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror"
                                        name="category_id" value="{{ old('category_id') }}">
                                    <option value="0">Mời bạn chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Chọn tag</label>
                                <select class="form-control tags_select_choose" name="tags[]"
                                        multiple="multiple" value="{{ old('tags') }}">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Nhập nội dung</label>
                                <textarea class="form-control @error('contents') is-invalid @enderror"
                                          id="text" name="contents" rows="3">{{ old('contents') }}</textarea>
                                @error('contents')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/product/add/add.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'text', {
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
        } );
    </script>
    @include('ckfinder::setup')
@endsection



