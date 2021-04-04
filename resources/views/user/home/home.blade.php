@extends('user.layouts.master')
@section('title')
    <title>Home</title>
@endsection
@section('css')
    <link href="{{ asset('asset/css/responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!--slider-->
    @include('user.home.components.slider')
    <!--Endslider-->
    <section>
        <div class="container">
            <div class="row">
                @include('user.components.sidebar')
                <div class="col-sm-9 padding-right">
                    <!--feature Product-->
                @include('user.home.components.productHaveSeen')
                @include('user.home.components.featureProduct')
                @include('user.home.components.productSuggest')
                <!--End feature Product-->

                    <!--category-tab-->
                @include('user.home.components.categoryTab')


                <!--End category-tab-->

                    <!--recommended_items-->
                @include('user.home.components.recommendProduct')

                <!--End recommended_items-->
                <div id="productHaveSeen">

                </div>

                </div>

            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection
