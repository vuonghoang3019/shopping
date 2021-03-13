@extends('admin.admin')

@section('title')
    <title>Sliders</title>
@endsection
@section('content')
    <div class="content-wrapper">
    @include('layouts.content-header',['name' => 'Danh sách', 'key' => 'Sliders'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('slider-add')
                    <div class="col-md-12">
                        <a href="{{ route('sliders.create') }}" class="btn btn-success">ADD</a>
                    </div>
                    @endcan
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên slider</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col" colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt=1 ?>
                            @foreach($sliders as $data)
                                <tr>
                                    <th scope="row">{{ $stt }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{!! \Illuminate\Support\Str::limit($data->description,20)  !!}</td>
                                    <td>
                                        <img src="{{ $data->image_path }}" width="100" height="100">
                                    </td>
                                    <td>{{ optional($data->category)->name }}</td>
                                    <td>
                                        @can('slider-edit')
                                        <a href="{{ route('sliders.edit',['id'=> $data->id]) }}"
                                           class="btn btn-default">Edit
                                        </a>
                                        @endcan
                                        @can('slider-delete')
                                        <a href=""
                                           data-url="{{ route('sliders.delete',['id'=> $data->id]) }}"
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
                        {{ $sliders->links('pagination::bootstrap-4') }}
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
