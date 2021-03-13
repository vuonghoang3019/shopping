@extends('admin.admin')

@section('title')
    <title>Add product</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'Slider','key' => 'Edit'])
        <div class="col-md-12">
        </div>
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('sliders.update',['id' => $sliderEdit->id ]) }}" method='post' enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nhập tên sản phẩm" name="name" value="{{ $sliderEdit->name }}">
                                @error('name')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh đại diện</label>
                                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" placeholder="Chọn ảnh đại diện" name="image_path" value="{{ $sliderEdit->image_path }}">
                                @error('image_path')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ $sliderEdit->image_path }}" width="100" height="100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nhập nội dung</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="text" name="description" rows="3">{{ $sliderEdit->description }}</textarea>
                                @error('description')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'description', {
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
        } );
    </script>
    @include('ckfinder::setup')
@endsection



