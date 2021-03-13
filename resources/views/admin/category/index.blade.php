@extends('admin.admin')

@section('title')
    <title>Trang chủ</title>

@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'Danh sách danh mục', 'key' => ''])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('category-add')
                    <div class="col-md-12">
                        <a href="{{ route('categories.create') }}" class="btn btn-success">ADD</a>
                    </div>
                    @endcan
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                           <?php $stt=0 ?>
                                @foreach($categories as $data)
                                <tr>
                                    <th scope="row">{{ $stt }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        @can('category-edit')
                                        <a href="{{ route('categories.edit',['id' => $data->id]) }}" class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('category-delete')
                                        <a href=""
                                           data-url="{{ route('categories.delete',['id' => $data->id]) }}"
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
                        {{ $categories->links('pagination::bootstrap-4') }}
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

