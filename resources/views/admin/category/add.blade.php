@extends('admin.admin')

@section('title')
    <title>Trang chủ</title>

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('layouts.content-header',['name' => 'Category','key' => 'Add'])
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                    <form action="{{ route('categories.store') }} " method='post'>
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="">Nhập tên danh mục</label>
                            <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Chọn danh mục cha</label>
                            <select class="form-control" name="parent_id">
                                <option value="">------Mời bạn chọn danh mục------</option>
                                <option value="0">Chọn làm danh mục cha</option>
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

