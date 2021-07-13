@extends('layouts.login')

@section('content')
    <div class="leftHalf" style="background-image: url('/img/banner.jpg')">
        <div class="login-promo-txt">
            <h2>Are you traveling to the UK? And you want to make your UK Covid Testing Booking?</h2>
            <p>Covid19 Tests for International Arrivals – Day 2 and 8 Amber Country</p>
        </div>
    </div>

    <div class="rightHalf">
        <div class="position-relative">
            <!--login form-->
            <div class="login-form">
                <h2 class="text-center mb-1">
                    <a href="/">
                        <img src="/img/logo-dark.png" srcset="/img/logo-dark.png" style="height: 80px;" alt="Uk Travel test">
                    </a>
                </h2>
                <h4 class="text-uppercase- text-purple text-center mb-1">Login into your account</h4>
                <p>Are you trying to make a booking? kindly click this <a href="/booking">link</a> to book</p>
                @include('errors.showerrors')
                <form action="{{ url('/login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter Password">
                    </div>

                    <div class="form-group clearfix">
                        <button type="submit" class="btn btn-purple btn-pill float-right">LOGIN</button>
                    </div>

                </form>
            </div>
            <!--/login form-->
        </div>
    </div>
@endsection