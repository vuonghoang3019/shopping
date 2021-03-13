@if($orders)
@endif
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
    <?php $stt = 1;?>
    @foreach($orders as $key => $order)
        <tr>
            <td>{{ $stt }}</td>
            <td><a href="">{{ $order->product->name }}</a></td>
            <td>
                <img src="{{ config('app.base_url').$order->product->feature_image_path }}" width="100" height="100">
                </td>
            <td>{{ number_format($order->price) }} VNĐ</td>
            <td>{{ number_format($order->quantity) }} </td>
            <td>{{ number_format($order->quantity * $order->price) }} VNĐ </td>

        <?php $stt ++ ?>
    @endforeach
    </tbody>
</table>
