<div class="recommended_items">
    <h2 class="title text-center">Product Have Seen</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($products as $keyRecommend => $data)
                @if($keyRecommend % 3 == 0)
                    <div class="item {{ $keyRecommend == 0 ? 'active' : ''}}">
                        @endif
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{ config('app.base_url').$data->feature_image_path }}" alt=""
                                             width="134" height="268"/>
                                        <h2>{{ number_format($data->price) }} VNĐ</h2>
                                        <p>{{ $data->name }}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @if($keyRecommend % 3 == 2)
                    </div>
                @endif
            @endforeach
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel"
           data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel"
           data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {
            let renderProduct = '{{ route('productHaveSeen') }}';
            let checkRenderProduct = false;
            $(document).on('scroll', function () {
                if ($(window).scrollTop() > 400 && checkRenderProduct == false) {
                    checkRenderProduct = true;
                    let products = localStorage.getItem('products');
                    products = $.parseJSON(products);
                    if (products.length > 0) {
                        $.ajax({
                            url: renderProduct,
                            type: 'POST',
                            data: {id: products},
                            success: function (result) {
                                $("#productHaveSeen").html('').append(result.data);
                            }
                        });
                    }
                }
            })
        });
    </script>
@endsection

