@extends('admin.admin')

@section('title')
    <title>Users</title>
@endsection
@section('content')
    <div class="content-wrapper">
    @include('layouts.content-header',['name' => 'Danh sách ', 'key' => 'User'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('user-add')
                    <div class="col-md-12">
                        <a href="{{ route('users.create') }}" class="btn btn-success">ADD</a>
                    </div>
                    @endcan
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col" colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt=1 ?>
                            @foreach($users as $data)
                                <tr>
                                    <th scope="row">{{ $stt }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>
                                        <img src="{{ $data->image }}" width="100" height="100">
                                    </td>
                                    <td>
                                        @can('user-edit')
                                        <a href="{{ route('users.edit',['id' => $data->id]) }}"
                                           class="btn btn-default">Edit
                                        </a>
                                        @endcan
                                        @can('user-delete')
                                        <a href=""
                                           data-url="{{ route('users.delete',['id' => $data ]) }}"
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
                        {{ $users->links('pagination::bootstrap-4') }}
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
