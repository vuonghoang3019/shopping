@extends('admin.admin')

@section('title')
    <title>Rating</title>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'List Rate', 'key' => 'Rating'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('product-add')
                        <div class="col-md-1 mb-2">
                            <a href="" class="btn btn-success">ADD</a>
                        </div>
                    @endcan
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Product</th>
                                <th scope="col">Img</th>
                                <th scope="col">Content</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt = 1 ?>
                            @foreach($ratings as $rating)
                                <tr>
                                    <th scope="row">{{ $stt }}</th>
                                    <td>{{ $rating->user->name }}</td>
                                    <td>{{ $rating->product->name }}</td>
                                    <td><img src="{{ config('app.base_url').$rating->product->feature_image_path }}" width="100" height="100"></td>
                                    <td>{{ Str::limit($rating->content,20) }}</td>
                                    <td>{{ $rating->number }}</td>
                                    <td>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php $stt++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 float-right">
                        {{--                        {{ $rating->links() }}--}}
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
