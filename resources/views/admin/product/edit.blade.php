@extends('admin.admin')

@section('title')
    <title>Edit product</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('layouts.content-header',['name' => 'Product','key' => 'Edit'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('products.update',['id' => $product->id]) }}" method='post' enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" placeholder="Nhập tên sản phẩm" name="name" value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <label for="price">giá sản phẩm</label>
                                <input type="text" class="form-control" placeholder="Nhập giá sản phẩm" name="price" value="{{ $product->price }}">
                            </div>
                            <div class="form-group">
                                <label for="price">Số lượng</label>
                                <input type="number" class="form-control" placeholder="100" name="quantity" value="{{ $product->quantity }}">
                            </div>
                            <div class="form-group">
                                <label for="price">Sale</label>
                                <input type="number" class="form-control" placeholder="10%" name="sale" value="{{ $product->sale }}">
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh đại diện</label>
                                <input type="file" class="form-control-file" placeholder="Chọn ảnh đại diện" name="feature_image_path">
                                <img src="{{ $product->feature_image_path }}" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Ảnh chi tiết</label>
                                <input type="file" multiple class="form-control" placeholder="Chọn ảnh chi tiết" name="image_path[]">
                                    @foreach($product->productImage as $data)
                                        <img src="{{ $data->image_path }}" width="100" height="100">
                                    @endforeach
                            </div>
                            <div class="form-group">
                                <label for="">Chọn danh mục</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="0">Mời bạn chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Chọn tag</label>
                                <select class="form-control tags_select_choose" name="tags[]" multiple="multiple">
                                    @foreach($product->tags as $data)
                                    <option value="{{ $data->name }}" selected>{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Nhập nội dung</label>
                                <textarea class="form-control" id="text" name="contents" rows="3">{{ $product->content }}</textarea>
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



