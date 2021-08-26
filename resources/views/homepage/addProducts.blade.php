@extends('layouts.home')
@section('style')
    
    <style>
        body {
            font-size: 14px;
            font-family: 'Raleway', sans-serif;
            padding: 0;
            margin: 0;
            width:100vw;
        }

        .link{
            text-decoration:none;
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
            background:#FA8072;
            color:#fff;
        }
        .bg-4{
            background:#F6D167;
            color:#fff;
        }
        .bg-5{
            background:#DF2E2E;
            color:#fff;
        }
        .bg-6{
            background:#989898;
            color:#fff;
        }
        .bg-7{
            background:#F3F3F3;
        }
        .bg-8{
            background:#616161;
        }
        .bg-9{
            background:#8d8d8d;
        }
        .bg-10{
            background:#D22F27;
        }
        .bg-11{
            background:#eaeaea;
        }
        .bg-white{
            background:#fff;
        }
        .bg-none{
            background:none;
        }

        /***** color */
        .color-1{
            color:#1A8BB3;
        }
        .color-2{
            color:#7FC8A9;
        }
        .color-3{
            color:#FA8072;
        }
        .color-4{
            color:#F6D167;
        }
        .color-5{
            color:#DF2E2E;
        }
        .color-6{
            color:#989898;
        }
        .color-7{
            color:#F3F3F3;
        }
        .color-8{
            color:#616161;
        }
        .color-9{
            color:#8d8d8d;
        }
        .color-10{
            color:#D22F27;
        }
        .color-11{
            color:#eaeaea;
        }
        .color-black{
            color:#000;
        }

        /***** border */
        .bd-1{
            border:1px solid #1A8BB3;
        }

        section{
            padding:50px 25vw;
        }

        /***** font size */
        .fs-30 {
            font-size: 30px;
        }
        .fs-28{
            font-size:28px;
        }
        .fs-20{
            font-size:20px;
        }
        .fs-18{
            font-size:18px;
        }
        .fs-16{
            font-size:16px;
        }

        /***** font weight */
        .fw-700{
            font-weight:700;
        }
        .fw-600{
            font-weight:600;
        }
        .fw-500{
            font-weight:500;
        }

        /***** alignment */
        .text-center{
            text-align:center;
        }
        .text-left{
            text-align:left;
        }
        .text-right{
            text-align:right;
        }

        /***** button */
        button{
            outline:none;
            border:none;
            background:none;
            box-sizing: border-box;
            border-radius: 5px;
            cursor:pointer;
        }
        .btn-1{
            padding:17px;
        }
        .btn-2{
            padding:7px 12.5px;
        }
        .btn-3{
            padding:13px 85px;
        }
        .btn-4{
            padding:20px 45px;
        }
        .btn-5{
            padding:15px;
            border-radius:13px;
        }


        /***** containers */
        .double-container{
            display:grid;
            grid-template-columns:repeat(2, 45%);
            justify-content:space-between;
        }

        


        /***** purchase */
        .purchase{
            padding:0 30pxpx;
        }
        .purchase .card-container{
            margin:50px 0;
        }
        .purchase .card-container .card{
            /* padding:24px 155px 24px 45px; */
            border-radius:8px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:20px;
        }
        .purchase .card-container .card .currency{
            margin-left:18px;
        }
        .purchase .card-container .card .quantity{
            margin:0 13px;
        }
        .purchase .card-container .card .quantity-summary{
            margin-left:13px;
        }

        /***** cart */
        .cart{
            padding:0 123px;
        }
        .cart .cart-container{
            margin:50px 0;
        }
        .cart .cart-container .card{
            display:grid;
            grid-template-columns:2fr 1fr 1fr 2fr;
            border-radius:5px;
            margin-bottom:25px;
        }
        .cart .cart-container .heading{
            margin-bottom:15px;
        }
        .cart .cart-container .card-item{
            height:80px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-right:1px solid #c2c2c2;
            padding:20px;
        }
        .cart .cart-container .card-item:first-child{
            justify-content:flex-start;
            padding-left:45px;
        }
        .cart .cart-container .card-item:last-child{
            justify-content:flex-end;
            border:none;
            padding-right:45px;
        }
        .cart .cart-container .card-item .remove-icon{
            margin-right:8px;
        }
        .cart .cart-container .total{
            text-align:right;
        }
        .cart .cart-container .total .price{
            margin-left:22px;
        }
        .cart .cart-container .button-container{
            margin:83px 0 50px 0;
            text-align:right;
        }
        

        /* start laptop version */
        @media screen and (max-width: 2450px) {
        }

       

        /* tab version */
        @media screen and (max-width: 1024px) {
            section{
                padding:50px;
            }

        }
        /* mobile version */
        @media screen and (max-width: 468px) {
            section{
                padding:50px 20px;
            }

            button{
                display:block;
                width:100%;
            }
            /***** purchase */
            .purchase{
                padding:0;
            }
            .purchase .card-container .card{
                padding:24px 20px;
                display:block;
            }
            .purchase .card-container .card .purchase-name{
                display:flex;
                justify-content:space-between;
                margin-bottom:20px;
            }
            .purchase .card-container .card .btn-2{
                display:inline-block;
                width:auto;
            }
        }
    
    </style>
@endsection
@section('content')
<div class="main-container">
   
        <header class="title" style="max-height: 300px !important;">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/hero14.jpg">
            </div>
            <div class="container align-bottom">
                <div class="row">
                    <div class="col-xs-12">
                    
                        <h1 class="text-white">COUNTRY TESTS</h1>
                    </div>
                </div><!--end of row-->
            </div><!--end of container-->
        </header>
        <section class="content">
            <div class="jumbotron bg-white">
            <div class="purchase">
                <div class="header text-center">
                    <!-- <div class="fw-700 fs-28">Travelling from the UK</div> -->
                </div>
                <div class="card-container" >
                @if(count($products) > 0)
               
                <div class="container" id="show-result">

                </div>
                <br>
                    @foreach($products as $vproduct)
                        
                        <div class="container bg-7" style="padding:20px;margin-bottom:20px">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-center"><span class="color-8 " >{{optional(optional($vproduct)->product)->name}}</span></p>
                                    <hr>
                                    <p class="text-center"><span class="color-8 " >{{optional(optional($vproduct)->vendor)->name}}</span></p>
                                    <hr>
                                    <p class="text-center"><span class=" ">£{{optional($vproduct)->price_pounds}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <div class="container" style="padding-top:70px">
                                
                                         <a onclick ="addCart('{{$vproduct->product->id}}', '{{$vproduct->vendor->id}}')" type="button" class="btn btn-block btn-info" style="background-color: #46b8da;">Add to cart</a>
                                    </div>
                                 </div>
                            </div>
                           
                        </div>
                    @endforeach
                @else
                    <h4 class="text-center">No product available for now</h4>
                @endif
                </div>
            </div>
            </div>
        </section>
</div>
@endsection
@section('script')
<script>
    //  function show() {
    //        console.log(1);
    //         $("#country-section").show();
    //    }

       function addCart(product_id, vendor_id)
       {

        var url = '/add/cart/' + product_id +'/'+ vendor_id;
            $("#show-result")
                .find('p')
                .remove()
                .end();
            $.get(url, function (data) {

                var holder = document.getElementById("show-result");
                var newNode = document.createElement('p');
                var close =  document.createElement('a');
                newNode.innerHTML = data;
                close.innerHTML = "X";
                holder.appendChild(newNode);
                newNode.appendChild(close);
                $("#show-result p a").addClass('close')
                $("#show-result p a").attr("data-dismiss","alert")
                $("#show-result p").addClass('alert alert-info')
            });
       }
</script>
@endsection