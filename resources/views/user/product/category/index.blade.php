@extends('user.layouts.master')
@section('title')
    <title>Trang chu</title>
@endsection
@section('css')
    <link href="{{ asset('asset/css/responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section>
        <div class="container">
            @include('user.components.sidebar')
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    @foreach($products as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{ config('app.base_url').$product->feature_image_path }}" alt="" width="250" height="250"/>
                                        <h2>{{ number_format($product->price) }} VNĐ</h2>
                                        <p>{{ $product->name }}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
{{--                                <div class="choose">--}}
{{--                                    <ul class="nav nav-pills nav-justified">--}}
{{--                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>--}}
{{--                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    @endforeach

                    <ul class="pagination">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </ul>
                </div><!--features_items-->
            </div>
        </div>
        </div>
    </section>
@endsection



