@extends('user.layouts.master')
@section('title')
    <title>Home</title>
@endsection
@section('css')
    <link href="{{ asset('asset/css/responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="{{ route('postLogin') }}" method="post">
                            @csrf
                            <input type="email" placeholder="Email Address" name="email" />
                            <input type="password" placeholder="Name" name="password" />
                            <span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <input type="text" placeholder="Name" name="name"/>
                            <input type="email" placeholder="Email Address" name="email"/>
                            <input type="password" placeholder="Password" name="password"/>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

@endsection
@section('js')

@endsection

