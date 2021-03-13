@extends('admin.admin')

@section('title')
    <title>Add setting</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'Setting','key' => 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('settings.update',['id'=>$settingEdit->id]) }}" method='post' enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Config key</label>
                                <input type="text" class="form-control @error('config_key') is-invalid @enderror" id="config_key" placeholder="Nhập tên sản phẩm" name="config_key" value="{{ $settingEdit->config_key }}">
                                @error('config_key')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(request()->type === 'Text')
                                <div class="form-group">
                                    <label for="">Config value</label>
                                    <input type="text" class="form-control @error('config_value') is-invalid @enderror" id="config_value" placeholder="Nhập tên sản phẩm" name="config_value" value="{{ $settingEdit->config_value }}">
                                    @error('config_value')
                                    <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'Textarea')
                                <div class="form-group">
                                    <label for="">Config value</label>
                                    <textarea name="config_value" class="form-control @error('config_value') is-invalid @enderror" rows="5">{{ $settingEdit->config_value }}</textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'Email')
                                    <div class="form-group">
                                        <label for="">Config value</label>
                                        <input type="Email" class="form-control @error('config_value') is-invalid @enderror" id="config_value" placeholder="Nhập tên sản phẩm" name="config_value" value="{{ $settingEdit->config_value }}">
                                        @error('config_value')
                                        <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                            @elseif(request()->type === 'Numer')
                                <div class="form-group">
                                    <label for="">Config value</label>
                                    <input type="number" class="form-control @error('config_value') is-invalid @enderror" id="config_value" placeholder="Nhập tên sản phẩm" name="config_value" value="{{ $settingEdit->config_value }}">
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



