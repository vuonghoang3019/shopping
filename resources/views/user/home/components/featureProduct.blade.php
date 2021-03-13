<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    @foreach($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        @if($product->quantity == 0)
                            <span style="background: #e91e63;color: whitesmoke; position: absolute">Tạm hết hàng</span>
                        @endif
                        @if($product->sale)
                            <span style="position: absolute;right: 0;background-image: linear-gradient(-90deg,#ec1f1f 0%,#ff9c00 100%);
                        border-radius: 10px; padding: 1px 7px; padding-left: 0; padding-right: 10px">{{ $product->sale }}%</span>
                        @endif
                        <a href="{{ route('productDetail',['id' => $product->id]) }}"><img
                                src="{{ config('app.base_url').$product->feature_image_path }}" alt="" width="255"
                                height="238"/></a>

                        <h2>{{ number_format($product->price)  }} VNĐ</h2>
                        <p>{{ $product->name }}</p>
                        <a href="=" class="btn btn-default add-to-cart "
                           data-url="{{ route('addToCart',['id' => $product->id]) }}">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </a>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach

</div>
@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('admins/alert.js') }}"></script>
@endsection
