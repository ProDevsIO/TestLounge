@extends('layouts.home')

@section('content')
@section('style')
    <style>
       span , h2{
    font-family: nunito !important;
    font-size: 14px !important;
    font-style: normal !important;
    color:#FFFFFF;
}
label{
    font-family: Nunito;
    font-style: normal;
    font-weight: 600;
    font-size: 24px;
    line-height: 33px;
}
#child{
    margin:20px;
    font-family: Nunito;
    font-style: normal;
    font-weight: 300;
    font-size: 15px;
    line-height: 150%;
/* or 24px */



}
v{
    font-family: Nunito !important;
    font-style: normal !important;
    font-weight: bold !important;
    font-size: 15px !important;
    line-height: 25px !important;
}
.header h3{
    
    font-family: Nunito;
    font-style: normal !important;
    font-weight: 600 !important;
    font-size: 22px !important;
    line-height: 30px!important;
    text-align: center !important;

    color: #1B1B1B;

}
h1{
    font-family: Nunito !important;
    font-style: normal !important;
    font-weight: normal !important;
    font-size: 40px !important;
    line-height: 55px !important;
    color: #636363 !important;
}
.menu li a{
    font-family: nunito !important;
    font-size: 14px !important;
    font-style: normal !important;
    font-weight:lighter  !important;
   

}
.bg-sky{
    background-color:#F0F5F7;
    color:#1B1B1B;

}

.alert-blue{
    background-color: #87CEEB;
}
#nav-btn{
    border: 1px solid #1E50A0;
    color: #1E50A0;
}

#banner-writeup{
    /* position: absolute; */
    /* width: 533.98px; */
    /* height: 188.71px; */
    /* left: 107.96px; */
    /* top: 290.29px; */
    /* or 33px */
    color: #FFFFFF;
}

#banner-writeup{
    font-family: Nunito !important;
    font-style: normal !important;
    font-size: 22px !important;
    line-height: 150% !important;
   
}



 /* start laptop version */
 @media screen and (min-width: 1025px) {
    
    #banner2{
        padding-left:150px !important;
        padding-right:150px !important;
    }
    #banner-writeup-container a{
      
        margin-left:-350px !important;
    } 

    #banner-writeup{
        font-family: Nunito !important;
        font-style: normal !important;
        font-size: 22px !important;
        line-height: 150% !important;
        text-align:left !important;
    }
    
}

/* start laptop version */
@media screen and (max-width: 800px) {
    #banner-writeup2{
        display:none;
    }
}


        body {
            font-size: 14px;
           
            padding: 0;
            margin: 0;
        }
        .font-30 {
            font-size: 30px;
        }
        .header{
            padding:100px;
            display:grid;
            grid-template-columns:3fr 1fr;
        }

        .shadow {
        position: relative;
        box-shadow: 0 0 25px 0 rgba(50,50,50,.3) inset;
        }

        .shadow:after {
        content: "";
        position: relative;
        }

        .curved:after, .curved-2:after {
        position: relative;
        z-index: -2;
        }

        .curved:after {
        position: absolute;
        top: 50%;
        left: 12px;
        right: 12px;
        bottom: 0;
        box-shadow: 0 0px 10px 7px rgba(100,100,100,0.5);
        border-radius: 450px / 15px
        }
            table{
                border-collapse:collapse;
                /* width:1000px; */
                /* margin-top:20px; */
                width:100%;
            }
            thead{
                border-bottom:.5px solid #293459;
            }
            th{
                color:#FD6244;
                border:2px solid #fff;
                padding:15px;
                border-top:none;
            }
            /* img{
                width:10px;
                margin-left:10px;
            } */
            tr{
                text-align:center;
            }
            tr:nth-child(odd){
                background:#A6C3E0;
            }
            tr:nth-child(even){
                background:#d4e9ff;
            }
            td{
                padding:15px;
                border:2px solid #fff;
            }
            .icon{
                height:50px;
                width:auto;
            }
            th:last-child, td:last-child{
                border-right:none;
            }
            th:first-child, td:first-child{
                border-left:none;
            }
        
        .card {
            margin-bottom: 1.5rem;
            box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,.025);
        }
        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #e5e9f2;
            border-radius: .2rem;
        }
        .accordion li.active .text {
            padding: 24px;
            max-height: 1500px !important;
            border-bottom: 2px solid #dadada;
            opacity: 8 !important;
        }
        .background-image-holder.parallax-background {
        height: 140%;
        top: -33%;
        }
        .content{
            width:80vw;
            margin:auto;
        }
        .header{
            display:flex ;
        }
    </style>
    <style> 
        .fs-18{
            font-size:18px;
        }
        
        .h{
            text-align:center;
            margin:30px 0;
            font-weight:500;
        }
        .table{
            background: #FFFFFF;
            border-radius: 7px;
            font-weight:600;
        }
        .table .table-item{
            display:grid;
            grid-template-columns:1fr 1fr 1fr;
            padding:15px 63px;
            border-bottom:1px solid #eeeeee;
            align-items:center;
            transition:.4s ease-in-out all;
            min-height:75px;

        }
        .table .table-head{
            background:#0C6685;
            padding:35px 63px;
            color:#fff;
            border-radius:7px 7px 0 0;
            border:none;
        }
        .table .table-item div{
            width:206px;
            padding-right:0px;
        }
        .table .table-item div:last-child{
            padding:0;
        }
        .table .table-item-2{
            grid-template-columns:1fr 2fr;
        }
        .table .table-item-2 .table-col-2{
            text-align:center;
            width:100%;
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

        /* start laptop version */
        @media screen and (max-width: 2450px) {
           
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
            
            .table .table-item div{
                width:auto;
                padding-right:50px;
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
           
            .inner{
                display:flex;
                flex-wrap:nowrap;
                overflow:hidden;
                overflow-x:auto;
            }
            /* .table{
                width:1000px;
            } */
            .table .table-item{
                width:700px;
                /* min-width:150px; */
            }
            .table .table-item div{
                width:auto;
                padding-right:60px;
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
        }
    </style>
    <style>
   
    .link{
        text-decoration:none;
        color:white;
    }

    /***** background */
    .bg-1 {
        background: #1E50A0;
        color: #fff;
    }
    .bg-2 {
        background: #7FC8A9;
        color: #fff;
    }
    .bg-3 {
        background:#BBBEFF;
        color:#fff;
    }
    .bg-6 {
            background: #FFDF80 !important;
            color: #fff;
        }
    .bg-4{
        background:#FFF380;
        color:#fff;
    }
    .bg-5{
        background:#FF0000;
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

    /***** containers */
    .double-container{
        display:grid;
        grid-template-columns:repeat(3, 32%);
        justify-content:space-between;
    }

    /***** country category */
    .country-category{
        padding:0 2px;
    }
    .country-category .card-container{
        margin:50px 0;
    }
    .country-category .card-container .card{
        height:142px;
        border-radius:10px;
        display:flex;
        align-items:center;
        justify-content:center;
        margin-bottom:30px;
    }
    .country-category .card-container .card .inner{
        padding:40px;
    }


    /* start laptop version */
    @media screen and (max-width: 2450px) {
    }

    /* tab version */
    @media screen and (max-width: 1024px) {
        section{
            padding:50px;
        }

        /***** cart */
        .cart{
            padding:0;
        }

        /***** country category */
        .country-category, .form-page{
            padding:0;
        }

        /***** form page */
        .form-page form{
            padding:50px 0;
        }
    }

   
    /* mobile version */
    @media screen and (max-width: 800px) {
        .cart .cart-container .card{
            grid-template-columns:2fr 1fr 2fr 2fr;
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

        .double-container{
            display:block;
        }

        /***** navigation */
        .navigation{
            display:none;
        }

        /***** cart */
        .cart .cart-container .card{
            display:block;
        }
        .cart .cart-container .card-item{
            height:auto;
            display:flex;
            align-items:center;
            justify-content:center;
            border-right:none;
            border-bottom:1px solid #c2c2c2;
          
        }
        .cart .cart-container .card-item:first-child{
            justify-content:center;
           
        }
        .cart .cart-container .card-item:last-child{
            justify-content:center;
            
        }

        /***** form page */
        .form-page form{
            box-shadow:none;
            border:none;
        }
        .form-page form .button-container button{
            margin:0 0 28px 0;
        }
    }
 </style>
@endsection

    <div class="main-container">
        <header class="page-header">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/image 3 (1).png" >
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center" id="banner-writeup-container">
                            <div class="row">
                                    <div class="col-md-6 "style=" padding-top:100px">
                                        <h2 class="text-white space-bottom-medium" id="banner-writeup">We simplify the process of booking and making payments for Covid-19 UK Travel Tests for both travellers and travel agents. You’ll get up to date information on UK travel requirements and access to accredited test providers in the UK ensuring a hassle free travel experience.</h2>
                                        <!-- <a href="/#popular" class="btn btn-primary  btn-white">Learn more</a> -->
                                        <a href="/#calculator" class="btn btn-primary btn-filled " style="font-family: Nunito;font-style: normal;font-weight: lighter;font-size: 13.625px;line-height: 19px;">TRAVEL CALCULATOR</a>
                                    </div>
                                    <div class="col-md-6 pull-right" id="banner-writeup2" style="left:10%;top:100px ">
                                        <img class="background-image" alt="Background Image" src="/img/Group 6.png"  style="background-repeat: no-repeat;background-size: 100% 100%">
                                    </div>
                            </div>
                       
                        
                    </div>
                </div><!--end of row-->
            </div><!--end of container-->
        </header>
        <section class="clients-2" style="padding-bottom:20px">
				<div class="container">
					<div class="row">
                        <div class="col-md-3 col-sm-4" style="margin-top:40px">
                            <h1>Our Partners</h1>
                        </div>

                        <div class="col-md-3 col-sm-4">
							<h1><img alt="Client Logo" src="/img/london_test.png" style="max-width:200px;max-height:200px"></h1>
						</div>
						
						<div class="col-md-3 col-sm-4">
							<img alt="Client Logo" src="img/pexpo.png" style="max-width:180px;max-height:200px">
						</div>
						
						<div class="col-md-3 col-sm-4" style="margin-top:30px">
                            
							<img alt="Client Logo" src="img/allhealth.png" style="max-width:200px;max-height:200px">
						</div>
						
						{{--<div class="col-md-2 col-sm-4">--}}
							{{--<img alt="Client Logo" src="img/client4.png">--}}
						{{--</div>--}}
						{{----}}
						{{--<div class="col-md-2 col-sm-4">--}}
							{{--<img alt="Client Logo" src="img/client5.png">--}}
						{{--</div>--}}
						{{----}}
						{{--<div class="col-md-2 col-sm-4">--}}
							{{--<img alt="Client Logo" src="img/client6.png">--}}
						{{--</div>--}}
					</div><!--end of row-->
				</div><!--end of container-->
			</section>
                <div class="container-fluid" style="padding:0">
                    <div class="header text-center bg-1" style="padding:59px;">
                        
                        <div class="container" id="banner2">
                            <p style="font-weight:600px;font-size:20px;line-height: 41px;" class="fw-600 fs-20 text-left">The travel tests requirements are different for every country. It is important to check what these are when you’re planning your trip.</a></p>
                           <br>
                            <p class="fw-700 fs-28"> <a href="{{ url('/product/all') }}" type="button" class="btn btn-md bg-primary" style="border-radius:25px; padding:14px 28px 13px 28px;font-family: Nunito;font-style: normal;font-weight: bolder;font-size: 16px;line-height: 19px;color: #1E50A0 !important;background-color:white !important;">BOOK NOW</a></p>
                        </div>
                    </div>
                </div>
                <div class="card-container bg-sky"  style="padding:70px"id="country-section" style="">
                            <?php 
                                $countries = App\Models\Country::all();
                            
                            ?>
                        <div class="row" id="calculator">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <div id="show-result">

                                </div>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <br>
                        <div class="row" >
                            
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4 text-center">
                            
                                <label for="">Choose the country you’re travelling to</label>
                            </div>
                            <div class="col-sm-4">
                                <select name="" class="form-control" id="country" onchange="countryQuery()">
                                    <option value="">Select a country</option>
                                    <option value="225">United Kingdom</option>
                                    <!-- @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->nicename}} </option>
                                    @endforeach -->
                                </select>
                            </div>
                            <div class="col-sm 2"></div>
                        </div>
                </div>
           
     
        <!-- <section class="strip bg-secondary-1">
            <div class="container">
                <div class="row clearfix">
                   
                    <div class="col-md-12 col-xs-12 text-center">
                        <h5 class="text-white">If you do not know what category your country of origin belongs to , please click on this link for more information</h5>
                        <a href="https://www.gov.uk/guidance/red-amber-and-green-list-rules-for-entering-england" target="_blank" class="btn btn-primary btn-white">Click here</a>
                  
                    </div>
                </div>
            </div>
        </section>
       <br> -->
    
          
    </div>


@endsection
@section('script')
<script>
    //  function show() {
    //        console.log(1);
    //         $("#country-section").show();
    //    }

       function countryQuery()
       {
           window.location = '/view/uk/';
        // var country_id = document.getElementById("country").value;
        // console.log(country_id);
        // var url = '/country/query/' + country_id;
        //     $("#show-result")
        //         .find('p')
        //         .remove()
        //         .end();
        //     $.get(url, function (data) {

        //         var holder = document.getElementById("show-result");
        //         var newNode = document.createElement('p');
        //         var close =  document.createElement('a');
        //         newNode.innerHTML = data;
        //         close.innerHTML = "X";
        //         holder.appendChild(newNode);
        //         newNode.appendChild(close);
        //         $("#show-result p a").addClass('close')
        //         $("#show-result p a").attr("data-dismiss","alert")
        //         $("#show-result p").addClass('alert')
        //         $("#show-result p").addClass('p-5')
        //         $("#show-result p").attr("style", "background-color: #87CEEB;color:white")
               
        //     });
       }
</script>
@endsection