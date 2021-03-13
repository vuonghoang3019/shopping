@extends('admin.admin')

@section('title')
    <title>Add slider</title>
@endsection
@section('js')
    <script src="{{ asset('admins/role/add/add.js') }}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'RolesTest','key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('module_role.store') }}" method='post' enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tên quyền</label>
                                <input type="text" class="form-control" id="name" placeholder="Nhập tên sản phẩm" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Mô tả</label>
                                <input type="text" class="form-control" placeholder="Nhập vai trò" name="display_name" value="{{ old('display_name ') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="">
                                <label>
                                    <input type="checkbox" class="check_all">
                                    Check all
                                </label>
                            </div>
                            @foreach($modules as $moduleItem)
                                @foreach($moduleItem->child as $moduleChild)
                            <div class="card border-primary mb-3 col-mb-12">
                                <div class="card-header">
                                    <label for="">
                                        <input type="checkbox" value="{{ $moduleChild->id }}" class="checkbox_wrapper">
                                        {{ $moduleChild->name }}
                                    </label>
                                </div>
                                <div class="row">
                                    @foreach($moduleChild->details as $moduleChildItem)
                                    <div class="card-body text-primary col-md-3">
                                        <h5 class="card-title">
                                            <label for="" >
                                                <input type="checkbox"
                                                       value="{{ $moduleChildItem->id }}" name="module_detail_id[]"
                                                       class="checkbox_child">
                                                {{ $moduleChildItem -> display_name.' '.$moduleChildItem->value }}
                                            </label>
                                        </h5>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection


