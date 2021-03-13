@extends('admin.admin')

@section('title')
    <title>Products</title>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'Danh sách sản phẩm', 'key' => 'Products'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('product-add')
                        <div class="col-md-1 mb-2">
                            <a href="{{ route('products.create') }}" class="btn btn-success">ADD</a>
                        </div>
                    @endcan
                    <div class="col-md-6">
                        <form class="form-inline ml-4">
                            <div class="form-group">
                                <input class="form-control " name="search" type="search" placeholder="Search"
                                       value="{{ old('search') }}"
                                       aria-label="Search">
                            </div>
                            <div class="form-group">
                                <select class="form-control " name="category_id">
                                    <option value="0">Mời bạn chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt = 1 ?>
                            @foreach($products as $data)
                                <tr>
                                    <th scope="row">{{ $stt }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ number_format($data->price) }} VNĐ</td>
                                    <td>
                                        <img src="{{ $data->feature_image_path }}" width="100" height="100">
                                    </td>
                                    <td>{{ optional($data->category)->name }}</td>
                                    <td>
                                        @can('product-edit',$data->id)
                                            <a href="{{ route('products.edit',['id' => $data->id]) }}"
                                               class="btn btn-default">Edit
                                            </a>
                                        @endcan
                                        @can('product-delete')
                                            <a href=""
                                               data-url="{{ route('products.delete',['id' => $data->id]) }}"
                                               class="btn btn-danger action-delete">Delete
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                                <?php $stt++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 float-right">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('admins/delete.js') }}"></script>
@endsection
