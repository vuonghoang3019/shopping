@extends('admin.admin')
@section('title')
    <title>Trang chủ</title>
@section('content')
    <div class="content-wrapper">
    @include('layouts.content-header',['name' => 'Menu','key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('menus.store') }} " method='post'>
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="">Nhập tên menu</label>
                        <input type="text" class="form-control" placeholder="Nhập tên menu" name="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Chọn menu cha</label>
                        <select class="form-control" name="parent_id" required>
                            <option value="">Mời bạn chọn menu</option>
                            <option value="0">Đặt làm menu cha</option>
                            {!! $optionSelect !!}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

