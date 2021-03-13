@extends('admin.admin')

@section('title')
    <title>Edit Role</title>
@endsection
@section('js')
    <script src="{{ asset('admins/role/add/add.js') }}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'Roles','key' => 'Edit'])
        <div class="col-md-12">
        </div>
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('roles.update',['id' => $roleEdit->id]) }}" method='post' enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tên quyền</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nhập tên sản phẩm" name="name" value="{{ $roleEdit->name }}">
                                @error('name')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Mô tả</label>
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror" placeholder="Nhập vai trò" name="display_name" value="{{ $roleEdit->display_name }}">
                                @error('display_name')
                                <div class="alert alert-danger mt-2 px-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="">
                                <label>
                                    <input type="checkbox" class="check_all">
                                    Check all
                                </label>
                            </div>
                            @foreach($permissionsParent as $permissionParentItem)
                                <div class="card border-primary mb-3 col-mb-12">
                                    <div class="card-header">
                                        <label for="">
                                            <input type="checkbox" value="{{ $permissionParentItem->id }}" class="checkbox_wrapper">
                                        </label>
                                        {{ $permissionParentItem->name }}
                                    </div>
                                    <div class="row">
                                        @foreach($permissionParentItem->PermissionsChild as $PermissionsChildItem)
                                            <div class="card-body text-primary col-md-3">
                                                <h5 class="card-title">
                                                    <label for="" >
                                                        <input type="checkbox"
                                                               {{ $permission_Checked->contains('id',$PermissionsChildItem->id) ? 'checked' : '' }}
                                                               value="{{ $PermissionsChildItem->id }}" name="permission_id[]"
                                                               class="checkbox_child" >
                                                    </label>
                                                    {{ $PermissionsChildItem->name }}
                                                </h5>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection


