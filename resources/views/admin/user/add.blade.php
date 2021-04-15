@extends('admin.admin')

@section('title')
    <title>Add User</title>
@endsection
@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'User','key' => 'Add'])
        <div class="col-md-12">
        </div>
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('users.store') }}" method='post' enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nhập tên" name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Nhập email" name="email" value="{{ old('email') }}">
                                @error('email')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Nhập Password" name="password" value="{{ old('password') }}">
                                @error('password')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Password">Chọn vai trò</label>
                                <select name="role_id[]" class="form-control select2_init" multiple>
                                    <option value=""></option>
                                    @foreach ($roles as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="image">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">
                            @error('image')
                            <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/user/add/add.js') }}"></script>
@endsection


