@extends('user.layouts.master')
@section('title')
    <title>Cart</title>
@endsection
@section('css')
    <link href="{{ asset('asset/css/responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    @include('user.home.components.cartProduct')
    <section id="do_action">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                        <a class="btn btn-default check_out pull-right" href="{{ route('checkout') }}">Check Out</a>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script src="{{ asset('asset/js/actionCart.js') }}"></script>
@endsection

