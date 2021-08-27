@extends('layouts.home')
@section('style')

    <style>
        body {
            font-size: 14px;
            font-family: 'Raleway', sans-serif;
            padding: 0;
            margin: 0;
            width: 100vw;
        }

        .link {
            text-decoration: none;
        }

        /***** background */
        .bg-1 {
            background: #1A8BB3;
            color: #fff;
        }

        .bg-2 {
            background: #7FC8A9;
            color: #fff;
        }

        .bg-3 {
            background: #FA8072;
            color: #fff;
        }

        .bg-4 {
            background: #F6D167;
            color: #fff;
        }

        .bg-5 {
            background: #DF2E2E;
            color: #fff;
        }

        .bg-6 {
            background: #989898;
            color: #fff;
        }

        .bg-7 {
            background: #fafafa;
        }

        .bg-8 {
            background: #616161;
        }

        .bg-9 {
            background: #8d8d8d;
        }

        .bg-10 {
            background: #D22F27;
        }

        .bg-11 {
            background: #eaeaea;
        }

        .bg-white {
            background: #fff;
        }

        .bg-none {
            background: none;
        }

        /***** color */
        .color-1 {
            color: #1A8BB3;
        }

        .color-2 {
            color: #7FC8A9;
        }

        .color-3 {
            color: #FA8072;
        }

        .color-4 {
            color: #F6D167;
        }

        .color-5 {
            color: #DF2E2E;
        }

        .color-6 {
            color: #989898;
        }

        .color-7 {
            color: #F3F3F3;
        }

        .color-8 {
            color: #616161;
        }

        .color-9 {
            color: #8d8d8d;
        }

        .color-10 {
            color: #D22F27;
        }

        .color-11 {
            color: #eaeaea;
        }

        .color-black {
            color: #000;
        }

        /***** border */
        .bd-1 {
            border: 1px solid #1A8BB3;
        }

        section {
            padding: 50px 15vw;
        }

        /***** font size */
        .fs-30 {
            font-size: 30px;
        }

        .fs-28 {
            font-size: 28px;
        }

        .fs-20 {
            font-size: 20px;
        }

        .fs-18 {
            font-size: 18px;
        }

        .fs-16 {
            font-size: 16px;
        }

        /***** font weight */
        .fw-700 {
            font-weight: 700;
        }

        .fw-600 {
            font-weight: 600;
        }

        .fw-500 {
            font-weight: 500;
        }

        /***** alignment */
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        /***** button */
        button {
            outline: none;
            border: none;
            background: none;
            box-sizing: border-box;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-1 {
            padding: 17px;
        }

        .btn-2 {
            padding: 7px 12.5px;
        }

        .btn-3 {
            padding: 13px 85px;
        }

        .btn-4 {
            padding: 20px 45px;
        }

        .btn-5 {
            padding: 15px;
            border-radius: 13px;
        }

        /***** select input */
        .select {
            width: 45px;
            background: none;
            outline: none;
            border: none;
            border-bottom: 1px solid grey;
        }

        .select-2 {
            border: 1px solid #C8C8C8;
            box-sizing: border-box;
            border-radius: 6px;
            padding: 15px;
            display: block;
            width: 100%;
            outline: none;
        }

        /***** text input */
        input[type=text] {
            border: 1px solid #C8C8C8;
            box-sizing: border-box;
            border-radius: 6px;
            padding: 15px;
            display: block;
            width: 100%;
            outline: none;
        }

        /***** containers */
        .double-container {
            display: grid;
            grid-template-columns: repeat(2, 45%);
            justify-content: space-between;
        }

        /***** navigation */
        .navigation .top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 30px;
            margin-bottom: 50px;
            border-bottom: 1px solid #E5E5E5;
        }

        .navigation .top .left,
        .navigation .top .right {
            display: flex;
            align-items: center;
        }

        .navigation .top .left img {
            margin-right: 5px;
        }

        .navigation .bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navigation .bottom span {
            margin-right: 70px;
        }

        .navigation .bottom span:last-child {
            margin: 0;
        }

        .navigation .back {
            display: flex;
            align-items: center;
            margin-top: 60px;
        }

        /***** country category */
        .country-category {
            padding: 0 335px;
        }

        .country-category .card-container {
            margin: 50px 0;
        }

        .country-category .card-container .card {
            height: 142px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .country-category .card-container .card .inner {
            padding: 35px;
        }

        /***** purchase */
        .purchase {
            padding: 0 123px;
        }

        .purchase .card-container {
            margin: 50px 0;
        }

        .purchase .card-container .card {
            padding: 24px 155px 24px 45px;
            border-radius: 8px;
            display: ;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .purchase .card-container .card .currency {
            margin-left: 18px;
        }

        .purchase .card-container .card .quantity {
            margin: 0 13px;
        }

        .purchase .card-container .card .quantity-summary {
            margin-left: 13px;
        }

        /***** cart */
        .cart {
            padding: 0 0px;
        }

        .cart .cart-container {
            margin: 50px 0;
        }

        .cart .cart-container .card {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 2fr;
            border-radius: 5px;
            margin-bottom: 25px;
        }
        .cart_update_btn:hover{
            background-color:white;
        }
        .cart .cart-container .heading {
            margin-bottom: 15px;
        }

        .cart .cart-container .card-item {
            height: 120px;
            display: ;
            align-items: center;
            justify-content: center;
            border-right: 1px solid #c2c2c2;
            padding: 20px;
        }

        .cart .cart-container .card-item:first-child {
            justify-content: flex-start;
            padding-left: 45px;
        }

        .cart .cart-container .card-item:last-child {
            /* justify-content:flex-end; */
            border: none;
            padding-right: 45px;
        }

        .cart .cart-container .card-item .remove-icon {
            margin-right: 8px;
        }

        .cart .cart-container .total {
            text-align: right;
        }

        .cart .cart-container .total .price {
            margin-left: 22px;
        }

        .cart .cart-container .button-container {
            margin: 83px 0 50px 0;
            text-align: center;
        }

        /***** form page */
        .form-page {
            padding: 0 180px;
        }

        .form-page form {
            border: 1px solid #F2F2F2;
            box-sizing: border-box;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.04), 0px 2px 6px rgba(0, 0, 0, 0.04), 0px 0px 1px rgba(0, 0, 0, 0.04);
            border-radius: 7px;
            padding: 60px 80px;
            margin: 45px 0;
        }

        .form-page form .form-section {
            margin-bottom: 55px;
        }

        .form-page form .form-section .title {
            margin-bottom: 18px;
        }

        .form-page form .form-section .input-container {
            margin-bottom: 43px;
        }

        .form-page form .form-section .input-container .label {
            margin-bottom: 15px;
        }

        .form-page form .button-container {
            text-align: right;
            margin-top: 35px;
        }

        .form-page form .button-container button {
            margin-left: 28px;
        }

        .form-page form .flutterwave {
            margin-top: 23px;
        }

        /* .form-page form .form-section .input-container input{
    } */







        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */

        /* start laptop version */
        @media screen and (max-width: 2450px) {
            input[type=number]::-webkit-inner-spin-button {
                opacity: 1;
            }
        }

        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */

        /* tab version */
        @media screen and (max-width: 1024px) {
            input[type=number]::-webkit-inner-spin-button {
                opacity: 1;
            }

            section {
                padding: 50px;
            }

            /***** cart */
            .cart {
                padding: 0;
            }

            /***** country category */
            .country-category,
            .form-page {
                padding: 0;
            }

            /***** form page */
            .form-page form {
                padding: 50px 0;
            }
        }

        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */

        /* mobile version */
        @media screen and (max-width: 800px) {
            input[type=number]::-webkit-inner-spin-button {
                opacity: 1;
            }

            .cart .cart-container .card {
                grid-template-columns: 2fr 1fr 2fr 2fr;
            }
        }

        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */

        /* mobile version */
        @media screen and (max-width: 468px) {
            #cent{
                text-align:center;
            }
            input[type=number]::-webkit-inner-spin-button {
                opacity: 1;
            }

            section {
                padding: 50px 20px;
            }

            button {
                display: block;
                width: 100%;
            }

            .double-container {
                display: block;
            }

            /***** navigation */
            .navigation {
                display: none;
            }

            /***** cart */
            .cart .cart-container .card {
                display: block;
            }

            .cart .cart-container .card-item {
                height: auto;
                display: flex;
                align-items: center;
                justify-content: center;
                border-right: none;
                border-bottom: 1px solid #c2c2c2;
                padding: 20px;
            }

            .cart .cart-container .card-item:first-child {
                justify-content: center;
                padding-left: 20px;
            }

            .cart .cart-container .card-item:last-child {
                justify-content: center;
                padding-right: 20px;
            }

            /***** form page */
            .form-page form {
                box-shadow: none;
                border: none;
            }

            .form-page form .button-container button {
                margin: 0 0 28px 0;
            }

            /***** purchase */
            .purchase {
                padding: 0;
            }

            .purchase .card-container .card {
                padding: 24px 20px;
                display: block;
            }

            .purchase .card-container .card .purchase-name {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .purchase .card-container .card .btn-2 {
                display: inline-block;
                width: auto;
            }
        }

        input[type=number]::-webkit-inner-spin-button {
            opacity: 1;
        }

        .btn {
            min-width: auto;
        }

    </style>
@endsection
@section('content')
    <header class="title" style="max-height: 300px !important;">
        <div class="background-image-holder parallax-background">
            <img class="background-image" alt="Background Image" src="/img/hero14.jpg">
        </div>
        <div class="container align-bottom">
            <div class="row">
                <div class="col-xs-12">

                    <h1 id ="cent" class="text-white">CART</h1>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </header>
    <section class="content">

        @if ($carts->count() > 0)
            <div class="cart">
                <div class="header">
                    <div class="fw-700 fs-28 text-center">Cart ({{ $carts->count() }} Item)</div>
                </div>
                <div class="cart-container">
                    @include('errors.showerrors')

                    <div class="card heading text-center color-8">
                        <div>TESTS</div>
                        <div>QUANTITY</div>
                        <div>AMOUNT</div>
                        <div>OPTION</div>
                    </div>
                    <?php $i = 0; ?>
                    @foreach ($carts as $cart)
                        <br>
                        <div class="card fw-600 bg-7">
                            <div class="card-item color-1 name">
                                <span>{{ optional($cart->vendorProduct->product)->name }}</span>

                            </div>
                            <div class="card-item">
                                {{-- <select name="" class="form-control" id="quantity_{{$i}}" >
                                    @for ($y = 1; $y < 10; $y++)
                                        <option value="{{$y}}"  @if ($cart->quantity == $y)selected @endif>{{$y}}</option>
                                    @endfor
                                </select> --}}
                                <div class="input-group">
                                    <span class="input-group-addon cart_update_btn" data-action="remove">-</span>
                                    <input type="text" class="form-control text-center cart_input" id="quantity_{{$i}}"  value="{{ $cart->quantity }}"> 
                                    <span class="input-group-addon cart_update_btn" data-action="add">+</span>
                                </div>
                            </div>
                            <div class="card-item text-center">£{{ number_format($cart->quantity * $cart->vendorProduct->price_pounds, 2) }}</div>
                            <div class="card-item color-6 text-center ">
                               
                                <a type="button" class="btn btn-sm btn-info" style="background-color: #46b8da; margin:3px;"
                                    href="javascript:;" onclick="update(' {{ $cart->id }}', '{{ $i }}')"> <i
                                        class="icon icon_pencil" style="margin-right: 5px"> </i> Update </a>
                                        <br class="m-2">
                                <a type="button" class="btn btn-sm btn-danger" style="background-color:#d43f3a; margin:3px;"
                                    href="javascript:;" onclick="remove(' {{ $cart->id }}')"> <i
                                        class="icon icon_trash"> </i> Remove </a>
                                
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                    <div class="text-center fw-700 " style="font-size: 24px; margin-top: 50px">
                        TOTAL: <b class="color-1 price">£ {{ number_format($cartSum, 2) }}</b>
                    </div>
                    <div class="button-container">
                        <!-- <a class="btn-3 bg-none color-1 fw-600">Back to Shopping</a> -->
                        <a href="{{ url('/booking') }}" type="button" class="btn btn-sm btn-info" style="background-color: #46b8da;">Proceed</a>
                    </div>
                </div>
            </div>
        @else
            <div class="jumbotron">
                <h4 class="text-center">No products in cart</h4>
                <br>
                <center>
                    <a href="{{ url('/product/all') }}" class="btn-3 bg-1 color-1 fw-600" style="color:white; padding-right:10px; padding-left:10px;">Continue
                        shopping</a>
                </center>

            </div>
        @endif
    </section>
@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $('#data_table').DataTable({
                responsive: true,
                "order": []
            });
        });

        function update(id, count) {

            var q = "quantity_" + count;
            var quantity = document.getElementById(q).value;
             window.location.href = "/update/cart/" + id + "/" + quantity;
        }

        function remove(id) {

            var d = confirm("Are you sure you want to remove this item from cart?");

            if (d) {

                window.location = "/delete/cart/" + id;
            }
        }


        $(".cart_update_btn").on("click" , function() {
            const input = $(this).parent().find("input");
            if(input !== undefined){
                let inputValue = $(input[0])
                let value = parseInt(inputValue.val());
                const action = $(this).attr("data-action")
                if(action == "add"){
                    value = value+ 1
                }
                else{
                    if(value >= 2){
                        value = value - 1
                    }
                }
                inputValue.val(value)
            }
        })
    </script>
@endsection
