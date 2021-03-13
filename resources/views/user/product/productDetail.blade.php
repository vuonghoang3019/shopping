@extends('user.layouts.master')
@section('title')
    <title>Home</title>
@endsection
@section('css')
    <link href="{{ asset('asset/css/responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <?php $now = \Carbon\Carbon::now()->month; $date = \Carbon\Carbon::now() ?>
    <section>
        <div class="container">
            <div class="row">
                @include('user.components.sidebar')
                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{ $productDetails->feature_image_path }}" alt=""/>
                                <h3>ZOOM</h3>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    @foreach($productImage as $productImageItem)
                                        @foreach($productImageItem->productImage as $productImageKey => $data)
                                            @if($productImageKey % 3 == 0)
                                                <div class="item {{ $productImageKey == 0 ? 'active' : ''}}">
                                                    @endif
                                                    <a href="">
                                                        <img src="{{ config('app.base_url').$data->image_path }}"
                                                             alt=""/>
                                                    </a>
                                                    @if($productImageKey % 3 == 2)
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                                <!-- Controls -->
                                <a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <h2>{{ $productDetails->name }}</h2>
                                <span>
									<span>{{ number_format($productDetails->price) }} VNĐ</span>

									<label>Quantity: </label>
									 <input type="number" class="cart_add" id="num" value="1"
                                            name="quantity" min="1" max="100">

								</span>
                                <p><b>Availability:</b> In Stock</p>
                                <p><b>Condition:</b>
                                    @if($now - $productDetails->created_at->format('m') == 1 || $now - $productDetails->created_at->format('m') == 0)
                                        new
                                    @else
                                        old
                                    @endif
                                </p>
                                <a href=""
                                   class="btn btn-default cart add-to-cart-productDetail"
                                   data-url="{{ route('AddToCartProductDetail',['id' => $productDetails->id]) }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </a>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">


                            <div class="tab-pane fade active in" id="reviews">
                                <div class="col-sm-12">
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                        <li><a href=""><i class="fa fa-clock-o"></i>{{ $date->format('H: m') }}</a></li>
                                        <li><a href=""><i class="fa fa-calendar-o"></i>{{ $date->format('d M Y') }}</a>
                                        </li>
                                    </ul>
                                    <p><b>Write Your Review</b></p>

                                    <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
                                        <textarea name=""></textarea>
                                        <button type="button" class="btn btn-default pull-right">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div><!--/category-tab-->

                    @include('user.home.components.recommendProduct')

                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('admins/alert.js') }}"></script>
@endsection









