@extends('admin.admin')

@section('title')
    <title>Settings</title>
@endsection
@section('content')
    <div class="content-wrapper">
    @include('layouts.content-header',['name' => 'Danh sách cài đặt', 'key' => 'Settings'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('setting-add')
                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                Action
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('settings.create'). '?type=Text' }}">Text</a></li>
                                <li><a href="{{ route('settings.create'). '?type=Textarea' }}">Textarea</a></li>
                                <li><a href="{{ route('settings.create'). '?type=Email' }}">Email</a></li>
                                <li><a href="{{ route('settings.create'). '?type=Number' }}">Number</a></li>
                            </ul>
                        </div>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config Value</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt=1 ?>
                            @foreach($settings as $data)
                                <tr>
                                    <th scope="row">{{ $stt }}</th>
                                    <td>{{ $data->config_key }}</td>
                                    <td>{{ $data->config_value }}</td>
                                    <td>
                                        @can('setting-edit')
                                        <a href="{{ route('settings.edit',['id' => $data->id]) .'?type=' .$data->type }}"
                                           class="btn btn-default">Edit
                                        </a>
                                        @endcan
                                        @can('setting-delete')
                                        <a href=""
                                           data-url="{{ route('settings.delete',['id' => $data->id]) }}"
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
                        {{ $settings->links('pagination::bootstrap-4') }}
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
