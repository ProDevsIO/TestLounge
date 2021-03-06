@extends('layouts.login')

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
                margin-bottom:50px;
            }
        }
        @media (max-width: 768px){
            .leftHalf {
                min-height: 300px;
            }
            .rightHalf{
                padding: 0 5%;
            }
        }


        @media (min-width: 768px){
            .leftHalf {
                min-height: 300px;
            }
            .login_information{
                margin-top: 30%;
            }
            .login_information p{
                font-size: 30px;
            }
        }
    </style>
    <!-- <div class="leftHalf" style="background-image: url('/img/travel.jpeg')">

            <div class="login-promo-txt" style="height:100%; top:0; width:100%">
                <div class="container-fluid" id="backbutton"style="width:100%;">
                    <a href="/" class="btn btn-purple btn-pill float-left">Home page</a>
                <br>
                </div>
                <div class="container-fluid"  style="width:70%">
                    <h2>Are you a travel agent looking to grow your network of travelers</h2>
                </div>
            </div>
        </div> -->
    <div class="leftHalf" style="background-image: url('/img/banner.jpg');">

        <div class="login-promo-txt" style="height:100%; top:0; width:100%">
            <div class="container-fluid" id="backbutton"style="width:100%; margin-left: -20px;
    margin-top: 10px;">
                <a href="/" class="btn btn-purple btn-pill float-left">Home page</a>
                <br>
            </div>
            <div class="container-fluid text-left"  style="width:80%; padding: 5px;">
                <div class="login_information">
                    <p style="text-align: justify"><b>Are you a Travel agent , Company travel manager or frequent flier into the UK ?
                            You can join our partnership network which gives you access to discounts and value
                            added services. <a href="#">Learn More</a></b></p>
                </div>

            </div>
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
                <h4 class="text-uppercase- text-purple mb-1 text-center">Forgot Password</h4>
                @include('errors.showerrors')
                <form action="{{ url('/reset_password') }}" method="post">
                    @csrf
                    <div class="form-group mt-2">
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group clearfix">
                        <button type="submit" class="btn btn-purple btn-pill float-right">Reset Password</button>
                    </div>
                </form>
            </div>
            <!--/login form-->

        </div>
    </div>
@endsection