@extends('admin.admin')

@section('title')
    <title>Trang chủ</title>

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('layouts.content-header',['name' => 'Category','key' => 'Edit'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('categories.update',['id' => $category->id]) }} " method='post'>
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="">Nhập tên danh mục</label>
                        <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="name" value="{{ $category->name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Chọn danh mục cha</label>
                        <select class="form-control" name="parent_id">
                            <option value="0">Mời bạn chọn danh mục</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

