@extends('layouts.home')
@section('style')

    <style>
         .background-image-holder{
            background-color:#1E50A0 !important;
        }
        #cent {
                font-family: Nunito !important;
                font-style: normal !important;
                font-weight: 200 !important;
                font-size: 40px !important;
                line-height: 55px !important;
                text-align: left;
            }
            #go_button
            {
                border:1px solid #1E50A0;
                border-radius:25px !important;
                padding:10px 20px 10px 20px !important;
                color:#1E50A0; 
                background: white ;
                font-family: Nunito;
                font-style: normal;
                font-weight: bold;
                font-size: 12px;
                line-height: 41px;
                
            }

            #cart-header{
                margin-top:20%;
                font-family: Nunito;
                font-style: normal;
                font-weight: 800;
                font-size: 35px;
                line-height: 48px;

                color: #1B1B1B;
            }

            #cart-table-header{
                font-family: Nunito;
                font-style: normal;
                font-weight: bold;
                font-size: 20px;
                line-height: 34px;
                /* identical to box height */
                color: #1E50A0;
            }

            .cart_input{
                border:none !important;
                border-top:1px solid #B8B8B8 !important;
                border-bottom:1px solid #B8B8B8 !important;
            }
            #add_button
            {
                border-radius:25px !important;
                padding:14px 20px 13px 20px !important;
                color:white; 
                background: #1E50A0;
            }
            #x-icon{
               display:none;
            }
            #remove{
                border:none;
                font-family: Nunito;
                font-style: normal;
                font-weight: bold;
                font-size: 18px;
                line-height: 27px;
                background-color:#F0F5F7;;
                color: #FF0000;
            }
            #cart-text{
                font-family: Nunito !important;
                font-style: normal !important;
                font-weight: bold !important;
                font-size: 20px !important;
                line-height: 27px !important;
                color: #000000 !important;
            }

            #cart-total{
                margin-top:10%;
                font-family: Nunito;
                font-style: normal;
                font-weight: 800;
                font-size: 35px;
                line-height: 48px;

                color: #1B1B1B;
            }
            .input-group{
                width:70%;
                margin: auto;
                padding: 2px;
            }
            #underlay{
                border-radius:10px;
                background-color:#F0F5F7;
            }
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
            border-radius: 10px;
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

        .cart_update_btn:hover {
            background-color: #B2BEB5;
        }

        .cart .cart-container .heading {
            margin-bottom: 15px;
        }

        .cart .cart-container .card-item {
            height: 120px;
            display: ;
            align-items: center;
            justify-content: center;
            /* border-right: 1px solid #c2c2c2; */
            padding-top: 40px;
            border-radius:5%;
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
            #underlay{
                border-radius:10px;
                background:none;
            }
            #x-icon{
               display: inline-block; 
            }
            #cart-table-header{
                display:none;
             
            }
            .cart_input{
                border:none !important;
                border-top:1px solid #B8B8B8 !important;
                border-bottom:1px solid #B8B8B8 !important;
            }
            .cart-p{
                margin-top:-76px;
                margin-left: 20px
            }
            .input-group{
                width:40%;
                margin-right:60% !important;
            }
            #remove{
                margin-right:60% !important;
            }
            #cent {
                font-family: Nunito !important;
                font-style: normal !important;
                font-weight: 600 !important;
                font-size: 40px !important;
                line-height: 55px !important;
                text-align: center;
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
                border-radius:10px;
                display: block;
            }

            .cart .cart-container .card-item {
                height: auto;
                display: flex;
                align-items: center;
                justify-content: center;
                border-right: none;
               
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
                border-radius: 10px;
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
           
        </div>
        <div class="container align-bottom">
            <div class="row">
                <div class="col-xs-12">

                    <h1 id="cent" class="text-white">CART</h1>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </header>
    <section class="content bg-white">
    <div class="col-sm-12 text-let"><a id="go_button" href="{{ url('/view/cart') }}" type="button" class="btn bg-1"><img src="https://img.icons8.com/fluency/20/000000/left.png"/> Go to back to Test products </a></div>
        @if ($carts->count() > 0)
            <div class="cart">
                <div class="header">
                    <div class="fw-700 fs-28 text-center" id="cart-header">Cart: {{ $carts->count() }} Item</div>
                </div>
                <div class="cart-container" >
                    @include('errors.showerrors')

                    <div  class="card heading text-center color-8">
                        <div id="cart-table-header">Tests</div>
                        <div id="cart-table-header">Quantity</div>
                        <div id="cart-table-header">Amount</div>
                        <div id="cart-table-header">Option</div>
                    </div>
                    <?php $i = 0; ?>
                    <div id="underlay">
                    @foreach ($carts as $cart)
                        <br>
                        <div class="card fw-600 bg-12">
                            <div class="card-item text-left" id="cart-text">
                                <span>{{ optional($cart->vendorProduct->product)->name }}</span>

                            </div>
                            <div class="card-item" >
                                {{-- <select name="" class="form-control" id="quantity_{{$i}}" >
                                    @for ($y = 1; $y < 10; $y++)
                                        <option value="{{$y}}"  @if ($cart->quantity == $y)selected @endif>{{$y}}</option>
                                    @endfor
                                </select> --}}
                                
                                <div class="input-group">
                                     <span class="input-group-addon cart_update_btn bg-white" data-action="remove">-</span>
                                    
                                    <input type="text" style="" class="form-control text-center cart_input"
                                        id="quantity_{{ $i }}" value="{{ $cart->quantity }}"
                                        data-cart_id="{{ $cart->id }}" />
                                    
                                        <span class="input-group-addon cart_update_btn bg-white" data-action="add">+</span>
                                </div>
                                
                            </div>
                            <div class="card-item text-center cart-p" id="cart-text">£
                                <span id="cart_item_total_{{ $cart->id }}" >
                                    {{ number_format($cart->quantity * $cart->vendorProduct->price_pounds, 2) }}</span>
                            </div>
                            <div class="card-item color-6 text-center ">
                                <a id="remove" class="btn btn-sm btn-danger"
                                    href="javascript:;" onclick="remove(' {{ $cart->id }}')"> <i
                                        class="icon icon_cross_mark"> </i> <img id="x-icon"src="https://img.icons8.com/plumpy/20/000000/cancel.png"/> Remove </a>
                                <br class="m-2">
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                    </div>
                    <div class="text-center fw-700 " id="cart-total">
                        TOTAL: <b class="color-1 price">£ <span
                                id="totalCartPrice">{{ number_format($cartSum, 2) }}</span></b>
                    </div>
                    <div class="button-container">
                        <!-- <a class="btn-3 bg-none color-1 fw-600">Back to Shopping</a> -->
                        <a id="add_button" href="{{ url('/booking') }}" type="button" class="btn btn-sm btn-info"
                           >Proceed to checkout</a>
                    </div>
                </div>
            </div>
        @else
            <div class="jumbotron">
                <h4 class="text-center">No products in cart</h4>
                <br>
                <center>
                    <a href="{{ url('/product/all') }}" class="btn-3 bg-1 color-1 fw-600"
                        style="color:white; padding-right:10px; padding-left:10px;">Continue
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

        function update(btn, id, quantity) {
            btn.attr("disabled", true);
            const url = "/update/cart/" + id + "/" + quantity;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: url,
                data: null,
                dataType: 'json',
                success: function(data) {
                    $("#totalCartPrice").html(data.total_price);
                    btn.removeAttr("disabled");
                    $("#cart_item_total_" + id).html(data.item_total);
                },
                error: function(error) {
                    toastr.error('Error', 'Unable to process request')
                    btn.removeAttr("disabled");
                }
            });
        }

        function remove(id) {
            var d = confirm("Are you sure you want to remove this item from cart?");
            if (d) {
                window.location = "/delete/cart/" + id;
            }
        }


        $(".cart_update_btn").on("click", function() {
            const btn = $(this);
            const input = btn.parent().find("input");
            if (input !== undefined) {
                let inputValue = $(input[0])
                const value_ = parseInt(inputValue.val());
                let value = value_
                const action = btn.attr("data-action")
                if (action == "add") {
                    value = value + 1
                } else {
                    if (value >= 2) {
                        value = value - 1
                    }
                }
                if (value_ != value) {
                    inputValue.val(value)
                    update(btn, input.attr("data-cart_id"), value);

                }
            }
        })
    </script>
@endsection
