@extends('admin.admin')

@section('title')
    <title>Order</title>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('layouts.content-header',['name' => 'Danh sách', 'key' => 'Order'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Total</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt = 1 ?>
                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{ $stt }}</th>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ number_format($order->total) }} VNĐ</td>
                                    <td>
                                        {{ $order->customer->email }}
                                    </td>
                                    <td>
                                        {{ $order->created_at->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        @can('order-actionOrder')
                                            <a href="{{ route('order.actionOrder',['id' => $order->id]) }}"
                                               class="{{ $order->status == 1 ? 'btn btn-primary' : 'btn btn-default' }} ">
                                                {{ $order->status == 1 ? 'Đã xử lý' : 'Chưa xử lý' }}
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('order-viewDetail')
                                            <a href="{{ route('order.viewDetail',['id' => $order->id]) }}"
                                               class="btn btn-info js_order_item" data-id="{{ $order->id }}"
                                               data-toggle="modal"
                                               data-target="#modalOrder">View Detail
                                            </a>
                                        @endcan
                                        @can('order-delete')
                                            <a href=""
                                               data-url="{{ route('order.delete',['id' => $order->id]) }}"
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
                        {{ $orders->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Detail #<b class="order_id"></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body " id="md_content">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('admins/delete.js') }}"></script>
    <script>
        $(function () {
            $('.js_order_item').click(function (event) {
                event.preventDefault();
                let url = $(this).attr('href');
                $("#md_content").html('');
                $('.order_id').text($(this).attr('data-id'));
                $('#modalOrder').modal('show');
                $.ajax({
                    url: url
                }).done(function (result) {
                    if (result) {
                        $("#md_content").append(result);
                    }
                });
            });
        });
    </script>
@endsection
