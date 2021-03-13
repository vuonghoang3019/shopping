@extends('admin.admin')

@section('title')
    <title>Permission</title>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'Danh sách chức năng', 'key' => 'Permission'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('permissions.create') }}" class="btn btn-success">ADD</a>
                        </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên chức năng</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt=1 ?>
                            @foreach($permissions as $data)
                                <tr>
                                    <th scope="row">{{ $stt }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>
                                            <a href="{{ route('permissions.edit',['id' => $data->id]) }}"
                                               class="btn btn-default">Edit
                                            </a>
                                            <a href=""
                                               data-url="{{ route('permissions.delete',['id' => $data->id]) }}"
                                               class="btn btn-danger action-delete">Delete
                                            </a>

                                    </td>
                                </tr>
                                <?php $stt++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 float-right">
                        {{ $permissions->links('pagination::bootstrap-4') }}
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
