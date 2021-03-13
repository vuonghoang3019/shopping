@extends('admin.admin')

@section('title')
    <title>Edit Permission</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'Permission','key' => 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('permissions.update',['id' => $permissionEdit->id]) }}" method='post' enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">ChỌn module</label>
                                <select class="form-control" name="module_parent">
                                    <option value="">Chọn quyền </option>
                                    @foreach($modules as $data)
                                        <option
                                            value="{{ $data->route }}" @if($permissionEdit->name == $data->route) selected = 'selected' @endif>
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    @foreach(config('permission.module_childrent') as $data)
                                        <div class="col-md-3">
                                            <label for="">
                                                <input type="checkbox" id="" name="module_chilrent[]" value="{{ $data }}">
                                                {{ $data }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection



