<div class="category-tab">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            @foreach($categories as $keyCategory =>  $category)

                <li class="{{$keyCategory == 0 ? 'active' : ''}}">
                    <a href="#category_tab_{{ $category->id }}" data-toggle="tab">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content">
        @foreach($categories as $keyCategoryProduct =>  $categoryItemProduct)
            <div class="tab-pane fade {{ $keyCategoryProduct == 0 ? 'active in' : '' }} " id="category_tab_{{ $categoryItemProduct->id }}">
                @if($categoryItemProduct->products->count())
                @foreach($categoryItemProduct->products as $data)
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{ config('app.base_url').$data->feature_image_path }}" alt=""/>
                                        <h2>{{ number_format($data->price) }}</h2>
                                        <p>{{ $data->name }}</p>
                                        <a href="#" class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>Add to cart
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                @endforeach
                @else
                    <div class="col-sm-12">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                   <p class="form-control">No data</p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
