@extends('user.layouts.master')
@section('title')
    <title>Home</title>
@endsection
@section('css')
    <link href="{{ asset('asset/css/responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <style>
        .rating .active
        {
            color: #ff9705 !important;
        }
    </style>
    <?php $now = \Carbon\Carbon::now()->month; $date = \Carbon\Carbon::now() ?>
    <section>
{{--        {{ dd($arrayRatings) }}--}}
        <div class="container">
            <div class="row">
                @include('user.components.sidebar')
                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{ config('app.base_url').$productDetails->feature_image_path }}" alt=""/>
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
                                <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                                <li><a href="#reviews" data-toggle="tab">Rating</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="details">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <p> {!! $productDetails->content !!} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $ageDetail = 0;
                                if ($productDetails->total_rate)
                                    {
                                        $ageDetail = round($productDetails->total_number / $productDetails->total_rate);
                                    }
                            ?>
                            <div class="tab-pane fade " id="reviews">
                                <div class="component_rating_content">
                                    <div class="rating-item col-md-2">
                                        <span class="fa fa-star rating_item">
                                            <b>{{ $ageDetail }}</b>
                                        </span>
                                    </div>
                                    <div class="list_rating col-md-6">
                                            @foreach($arrayRatings as $key => $arrayRating)
                                            <?php
                                                $itemAge = round(($arrayRating['total'] / $productDetails->total_rate) * 100) ;
                                            ?>
                                                <div class="item_rating">
                                                    <div class="item_rating_star">
                                                        {{ $key }} <span class="fa fa-star"></span>
                                                    </div>
                                                    <div class="item_rating_line">
                                                        <span><b style="width: {{ $itemAge }}%"></b></span>
                                                    </div>
                                                    <div class="item_rating_number">
                                                        <a href="">{{ $arrayRating['total'] }} đánh giá </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                    </div>
                                    <div class="col-md-4 ">
                                        <a href="#" class="send-rate js_rating_action">Gửi đánh giá của bạn ei</a>
                                    </div>
                                </div>
                                <div class="col-sm-12 formRate hidden">
                                    <div class="form_rate">
                                        <p>Chọn đánh giá của bạn</p>
                                        <span class="list_star">
                                        @for($i = 1; $i<= 5; $i++)
                                                <i class="fa fa-star" data-key="{{ $i }}"></i>
                                            @endfor
                                    </span>
                                        <span class="list_text"></span>
                                        <input type="hidden" class="number_rating" value="">
                                    </div>
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                        <li><a href=""><i class="fa fa-clock-o"></i>{{ $date->format('H: m') }}</a></li>
                                        <li><a href=""><i class="fa fa-calendar-o"></i>{{ $date->format('d M Y') }}</a>
                                        </li>
                                    </ul>
                                    <p><b>Write Your Review</b></p>
                                    <textarea name="content" id="content"></textarea>
                                    <a href="{{ route('productRating',['id' => $productDetails->id]) }}"
                                       class="btn btn-default pull-right js_rating_product">SUBMIT</a>
                                </div>
                                <div class="col-sm-12">
                                    <div class="component_list_rating">
                                        @foreach($ratings as $rating)

                                        <div class="rating" style="margin: 10px 0">
                                            <div class="text-success">
                                                <span style="font-weight: bold; text-transform: capitalize">
                                                    {{$rating->user->name}}
                                                </span>
                                                <label class="">
                                                    <i class="fa fa-check-circle"></i>
                                                    Đã mua hàng tại Website
                                                </label>
                                            </div>
                                            <p>
                                                <span>
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa fa-star {{ $i <= $rating->number ? 'active' : '' }}" style="color: #999"></i>
                                                    @endfor
                                                </span>
                                                {{ $rating->content }}
                                            </p>
                                            <div>
                                                <span><i class="fa fa-clock-o"></i>  {{ $rating->created_at }}</span>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    @include('user.home.components.recommendProduct')

                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('admins/alert.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {
            let listStar = $(".list_star .fa");
            listRate = {
                1: 'Không thích',
                2: 'Tạm được',
                3: 'Bình thường',
                4: 'Rất tốt',
                5: 'Tuyệt vời',
            };
            listStar.mouseover(function () {
                let $this = $(this);
                let number = $this.attr('data-key');
                listStar.removeClass('rating_active');
                $(".number_rating").val(number);
                $.each(listStar, function (key, value) {
                    if (key + 1 <= number) {
                        $(this).addClass('rating_active');
                    }

                });
                $(".list_text").text('').text(listRate[$this.attr('data-key')]).show();
            });
            $(".js_rating_action").click(function (event) {
                event.preventDefault();
                if ($(".formRate").hasClass('hidden')) {
                    $(".formRate").addClass('active').removeClass('hidden');
                } else {
                    $(".formRate").addClass('hidden').removeClass('active');
                }
            });
            $(".js_rating_product").click(function (event) {
                event.preventDefault();
                let content = $("#content").val();
                let number = $(".number_rating").val();
                let url = $(this).attr('href');
                if (content && number) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            number: number,
                            contents: content
                        }
                    }).done(function (result) {
                        if (result.code == 200) {
                            alert("GUI DANH GIA THANH CONG");
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection









