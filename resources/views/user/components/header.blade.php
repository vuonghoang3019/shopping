<header id="header">
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> {{ getConfigValueSetting('phone_contact') }}</a>
                            </li>
                            <li><a href="#"><i class="fa fa-envelope"></i> {{ getConfigValueSetting('email') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ getConfigValueSetting('facebook_link') }}"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 clearfix">
                    <div class="logo pull-left">
                        <a href="{{ route('home') }}"><img src="{{ asset('asset/images/home/logo.png') }}" alt=""/></a>
                    </div>
                    <div class="btn-group pull-right clearfix">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                Language
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{!! route('change-language', ['vi']) !!}">VN</a></li>
                                <li><a href="{!! route('change-language', ['en']) !!}">EN</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 clearfix">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            @if(auth()->check())
                                <li><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> {{ auth()->user()->name}}</a></li>
                                <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
                                <li><a href="{{ route('showCart') }}"><span class="cartCount" >
                                               {{ isset($carts) ?  count($carts) : '0' }}
                                        </span><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                <li><a href="{{ route('logout') }}"><i class="fa fa-lock"></i> Logout</a></li>
                            @else
                                <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
                                <li><a href="{{ route('showCart') }}"><span class="cartCount" >
                                               {{ isset($carts) ?  count($carts) : '0' }}
                                        </span><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                <li><a href="{{ route('loginUser') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    @include('user.home.components.mainMenu')


                </div>

                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header>
