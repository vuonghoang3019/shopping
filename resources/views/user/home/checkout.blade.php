@extends('user.layouts.master')
@section('title')
    <title>Check out</title>
@endsection
@section('css')
    <link href="{{ asset('asset/css/responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            <div class="step-one">
                <h2 class="heading">Step1</h2>
            </div>

            <div class="checkout-options">
                <h3>New User</h3>
                <p>Checkout options</p>
                <ul class="nav">
                    <li>
                        <label><input type="radio" name="typeLogin" checked> Register Account</label>
                    </li>
                    <li>
                        <label><input type="radio" name="typeLogin"> Guest Checkout</label>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-times"></i>Cancel</a>
                    </li>
                </ul>
            </div><!--/checkout-options-->

            <div class="register-req">
                <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as
                    Guest</p>
            </div><!--/register-req-->
            <form action="{{ route('storeCart') }}" method="post">
                @csrf
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="bill-to">
                            <p>Bill To</p>
                            <div class="form-group">
                                <input type="text" placeholder="Name" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Address" name="address" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="number" placeholder="Phone" name="phone" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="order-message">
                            <p>Shipping Order</p>
                            <textarea name="note" placeholder="Notes about your order, Special Notes for Delivery"
                                      rows="8"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-payment">
                <h2>Payment</h2>
            </div>


            @include('user.home.components.cartProduct')

            <div class="payment-options col-sm-6">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
                <span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
                <span>
						<label><input type="checkbox"> Paypal</label>
					</span>
            </div>
            <div class="payment-options col-sm-6">
                <button type="submit" class="btn btn-info pull-right">Submit</button>
            </div>
            </form>
        </div>

    </section> <!--/#cart_items-->
@endsection
@section('js')
    <script src="{{ asset('asset/js/actionCart.js') }}"></script>
@endsection
