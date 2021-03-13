@extends('admin.admin')

@section('title')
    <title>Role</title>
@endsection
@section('content')
    <div class="content-wrapper">
    @include('layouts.content-header',['name' => 'Danh sách  ', 'key' => 'Role'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('roles.create') }}" class="btn btn-success">ADD</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Quyền</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col" colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt=1 ?>
                            @foreach($roles as $data)
                                <tr>
                                    <th scope="row">{{ $stt }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->display_name }}</td>
                                    <td>{{ optional($data->category)->name }}</td>
                                    <td>
                                        <a href="{{ route('roles.edit',['id' => $data->id]) }}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url=""
                                           class="btn btn-danger action-delete">Delete</a>
                                    </td>
                                </tr>
                                <?php $stt++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 float-right">
                        {{ $roles->links('pagination::bootstrap-4') }}
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
