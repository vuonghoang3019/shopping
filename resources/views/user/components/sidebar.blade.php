<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach($categories as $category)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            @if($category->categoryChild->count())
                            <a data-toggle="collapse" data-parent="#accordian" href="#sportswear_{{ $category->id }}">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{ $category->name }}
                            </a>
                            @else
                                <a href="{{ route('category.product',['slug' => $categoryChildrent->slug,'id' => $categoryChildrent->id ]) }}">
                                    {{ $category->name }}
                                </a>
                            @endif
                        </h4>
                    </div>
                    <div id="sportswear_{{ $category->id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($category->categoryChild as $categoryChildrent)
                                    <li>
                                        <a href="{{ route('category.product',['slug' => $categoryChildrent->slug,'id' => $categoryChildrent->id ]) }}">
                                            {{ $categoryChildrent->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!--/category-products-->
        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="{{ request()->fullUrlWithQuery(['price' => 1]) }}">  100.000 < </a></li>
                    <li><a href="{{ request()->fullUrlWithQuery(['price' => 2]) }}"> 100.000 - 300.000</a></li>
                    <li><a href="{{ request()->fullUrlWithQuery(['price' => 3]) }}"> 300.000 - 500.000</a></li>
                    <li><a href="{{ request()->fullUrlWithQuery(['price' => 4]) }}"> 500.000 - 700.000</a></li>
                </ul>
            </div>
        </div><!--/brands_products-->
        <div class="">
            <form id="form_order" method="get">
                <label>Sắp xếp sản phẩm</label>
                <select class="form-control orderBy" name="orderBy">
                    <option value="" selected>---Mời bạn chọn---</option>
                    <option value="desc" >Mới nhất</option>
                    <option value="price_max" >Gía tăng dần</option>
                    <option value="price_min" >Gía giảm dần</option>
                </select>
            </form>
        </div>

    </div>
</div>
