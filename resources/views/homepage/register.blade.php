@extends('layouts.login')
@section('style')

@endsection
@section('content')
<style>
    #backbutton{
        margin-bottom:190px;
    }
    @media screen and (max-width: 800px) {
        #backbutton{
            margin-bottom:90px;
         }
    }
    @media screen and (max-width: 600px) {
        #backbutton{
            margin-bottom:70px;
         }
    }
</style>

    <div class="leftHalf" style="background-image: url('/img/travel.jpeg')">
        
        <div class="login-promo-txt" style="height:100%; top:0; width:100%">
            <div class="container-fluid" id="backbutton"style="width:100%;">
                <a href="/" class="btn btn-purple btn-pill float-left">Home page</a>
            <br>
            </div>
            <div class="container-fluid"  style="width:70%">
                <h2>Are you a travel agent looking to grow your network of travelers</h2>
            </div>
        </div>
    </div>

    <div class="rightHalf">
        <div class="position-relative">
            <!--login form-->
            <div class="login-form" style="padding-top:40px;">
                <h2 class="text-center mb-1">
                    
                    <a href="/">
                        <img src="/img/logo-dark.png" srcset="/img/logo-dark.png" style="height: 80px;" alt="Uk Travel test">
                    </a>
                </h2>
                <h4 class="text-uppercase- text-purple text-left mb-1">Register</h4>
                <p>Register to create an Account</p>
                @include('errors.showerrors')
                <form action="{{ url('/register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" value="{{ old('first_name') }}" name="first_name" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('last_name') }}" name="last_name" class="form-control"  placeholder="last Name" required>
                    </div>
                    <div class="form-group">
                        <input type="number" value="{{ old('phone_no') }}" name="phone_no" class="form-control"  placeholder="Phone No" required>
                    </div>

                    <div class="form-group">
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required>
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter Password" required>
                    </div>
                    
                        <p>Already have an account? <a href="/login"> Login</a></p>
                    
                    <div class="form-group clearfix">
                        <button type="submit" class="btn btn-purple btn-pill float-right">Register</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


@endsection