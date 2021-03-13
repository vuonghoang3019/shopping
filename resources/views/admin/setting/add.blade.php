@extends('admin.admin')

@section('title')
    <title>Add setting</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'Setting','key' => 'Add'])
        <div class="col-md-12">
        </div>
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('settings.store') . '?type=' . request()->type }}" method='post'
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Config key</label>
                                <input type="text" class="form-control @error('config_key') is-invalid @enderror"
                                       id="config_key" placeholder="Nhập tên sản phẩm" name="config_key"
                                       value="{{ old('config_key') }}">
                                @error('config_key')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(request()->type === 'Text')
                                <div class="form-group">
                                    <label for="">Text</label>
                                    <input type="text" class="form-control @error('config_value') is-invalid @enderror"
                                           id="config_value" placeholder="Nhập giá trị" name="config_value"
                                           value="{{ old('config_value') }}">
                                    @error('config_value')
                                    <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'Textarea')
                                <div class="form-group">
                                    <label for="">Text area</label>
                                    <textarea name="config_value"
                                              class="form-control @error('config_value') is-invalid @enderror"
                                              rows="5"></textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'Email')
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="Email" class="form-control @error('config_value') is-invalid @enderror"
                                           id="config_value" placeholder="Nhập Email" name="config_value"
                                           value="{{ old('config_value') }}">
                                    @error('config_value')
                                    <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'Number')
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="number"
                                           class="form-control @error('config_value') is-invalid @enderror"
                                           id="config_value" placeholder="Nhập số điện thoại" min="1" max="13"
                                           name="config_value" value="{{ old('config_value') }}">
                                    @error('config_value')
                                    <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
{{--@section('js')--}}
{{--    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>--}}
{{--    <script>--}}
{{--        CKEDITOR.replace( 'description', {--}}
{{--            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',--}}
{{--        } );--}}
{{--    </script>--}}
{{--    @include('ckfinder::setup')--}}
{{--@endsection--}}



