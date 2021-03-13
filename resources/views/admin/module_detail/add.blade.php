@extends('admin.admin')

@section('title')
    <title>Add slider</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'Module_detail','key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('module_detail.store') }}" method='post' enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nhập tên Mô tả quyền</label>
                                <input type="text" class="form-control" name="display_name" placeholder="Hãy nhập tên">
                            </div>
                            <div class="form-group">
                                <label for="">ChỌn module</label>
                                <select class="form-control" name="module_id">
                                    <option value="">Chọn Module </option>
                                    @foreach($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                                            @foreach($module->child as $item)
                                                <option value="{{ $item->id }}">--{{ $item->name }}</option>
                                            @endforeach
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



