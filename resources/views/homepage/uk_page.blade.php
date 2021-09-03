@extends('layouts.home')

@section('style')
<style>
    #nav-btn {
        border: 1px solid #fff !important;
        color: #fff !important;
    }
    .background-image-holder{
            background-color:#1E50A0 !important;
        }
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
@section('content')
<div class="main-container" style="margin-bottom: 50px">

        <header class="title" style="max-height: 300px !important;">
            <div class="background-image-holder parallax-background" >
                
            </div>
            <div class="container align-bottom">
                <div class="row">
                    <div class="col-xs-12">

                        <h5 id="h9" class="text-white">UNITED KINGDOM</h1>
                     
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </header>

        <div class="container">
                <div class="country-category">    
                    
                    <div class="card-container double-container fs-20 text-center">
                    
                        <a href="/product/Green" class="link text-white">
                            <div class="card bg-2 fw-700" style="">
                                    <div class="inner"><v>Travelling from a Green country to the UK</v></div>
                            </div>
                        </a>
                        <a href="/product/Amber_v" class="link">
                            <div class="card bg-6 fw-700">
                                    <div class="inner">
                                        <v>
                                        Travelling from an Amber country 
                                        (Vaccinated) to the UK
                                        </v>
                                    </div>
                            </div>
                        </a>
                        <a href="/product/Amber_uv" class="link text-white">
                            <div class="card bg-4 fw-700">
                                    <div class="inner">
                                        <v>
                                        Travelling from an Amber country
                                        (Unvaccinated) to the UK
                                        </v>
                                    </div>
                            </div>
                        </a>
                        <a href="/product/Red" class="link text-white">
                            <div class="card bg-5 fw-700">
                                    <div class="inner"><v>Travelling from a red country to the UK</v></div>
                            </div>
                        </a>
                        <a href="{{url('/product/UK')}}"  class="link text-white">
                            <div class="card bg-3 fw-700">
                                <div class="inner"><v>Travelling from the UK</div>
                            </div>
                        </a>
                        <a href="/product/all" class="link text-white ">
                            <div class="card" style="border:none;">
                                <div class="inner"><v>  <button type="button" class="btn btn-md" style="border-radius:25px; padding:14px 20px 13px 20px;color:white; background:#1E50A0"> View all tests</button> </v></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
           
        <div class="container">
            <div class="header bg-sky " style="">
                <div class="text-center">
                    <h3 style="">The Mandatory Covid-19 Tests for the UK follows a "traffic light system" which determines the required tests based on the  Country you are travelling from.<br><br> <p>See table below with the list of expected tests for each Category</p> </h3></div>
                <div>            
            </div>
        </div>

        <div class="table-responsive">
            <div class="visible-xs text-center">
                <img src="/img/slide_sideways.gif" style="height: 65px">
            </div>
            <table className="font-16" style="overflow-x:auto !important;">
                <thead>
                    <th class="bg-sky text-center">MEASURE REQUIRED</th>
                    <th class="bg-2 text-center">GREEN</th>
                    <th class="bg-6 text-center">AMBER(Vaccinated) **</th>
                    <th class="bg-4 text-center">AMBER(Unvaccinated)</th>
                    <th class="bg-5 text-center">RED</th>
                </thead>
                <tr>
                    <td class="bg-sky" width="25%"><h6>COMPLETE A PASSENGER LOCATOR FORM WITHIN 48 HOURS OF ARRIVAL</h6></td>
                    <td class="bg-2" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-6" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-4" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-5"  width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky" width="25%"><h6>PRE-DEPARTURE TEST AT DESTINATION WITHIN 72 HOURS OF TRAVEL</h6></td>
                    <td class="bg-2" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-6" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-4" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-5" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky" width="25%"><h6>MANDATORY PCR TEST UPON ENTRY TO UK ON/BEFORE DAY 2</h6></td>
                    <td class="bg-2" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-6" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-4" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-5" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky" width="25%"><h6>MANDATORY ADDITIONAL PCR TESTING ON DAY 8 OF ARRIVAL INTO THE UK</h6></td>
                    <td class="bg-2" width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                    </td>
                    <td class="bg-6" width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>  
                    </td>
                    <td class="bg-4" width="25%">
                        <h6>Required on day 8</h6>
                    </td>
                    <td class="bg-5" width="25%">
                        <h6>Required on day 8</h6>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky" width="25%"><h6 >OPTIONAL DAY 5 PCR TEST<br>( Test to Release )</h6></td>
                    <td class="bg-2" width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                    </td>
                    <td class="bg-6" width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/> 
                    </td>
                    <td class="bg-4" width="25%">
                    <h6> You can reduce the time required for self isolation to 5 days by taking a Day 5 Test; a negative Day 5 PCR Test allows you to immediately leave self isolation</h6>
                    </td>
                    <td class="bg-5" width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky" width="25%"><h6>SELF ISOLATION</h6></td>
                    <td class="bg-2" width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                    </td>
                    <td class="bg-6"  width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                     </td>
                    <td class="bg-4" width="25%">
                        <h6> 10 days of Isolation at the UK Isolation address provided in your passenger locator form.
                            You can reduce this time to 5days  following a negative PCR result taken on  Day 5 Test (  See above)</h6>
                    </td>
                    <td class="bg-5" width="25%">
                        <h6>10 days of Isolation in a Government approved Quarantine Hotel</h6>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky" width="25%"><h6>FIT TO FLY( PCR Test Taken before travel out of the UK  if required by destination country) </h6></td>
                    <td class="bg-2" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-6" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-4" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-5" width="25%">
                     <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky"></td>
                    <td class="bg-2">  <a href="{{ url('/product/Green') }}" style="font-family: Nunito;font-style: normal;font-weight: lighter;font-size: 13.625px;line-height: 19px;" class="btn btn-primary btn-filled">Book Now</a></td>
                    <td class="bg-6">  <a href="{{ url('/product/Amber_v') }}" style="font-family: Nunito;font-style: normal;font-weight: lighter;font-size: 13.625px;line-height: 19px;" class="btn btn-primary btn-filled">Book Now</a></td>
                    <td class="bg-4">  <a href="{{ url('/product/Amber_uv') }}" style="font-family: Nunito;font-style: normal;font-weight: lighter;font-size: 13.625px;line-height: 19px;" class="btn btn-primary btn-filled">Book Now</a></td>
                    <td class="bg-5"> <a href="{{ url('/product/Red') }}" class="btn btn-primary btn-filled"  style="font-family: Nunito;font-style: normal;font-weight: lighter;font-size: 13.625px;line-height: 19px;" >Book Now</a></td>
                </tr>
                
            </table>
            <div class="alert">
               <p style="font-family: Nunito;font-style: normal;font-weight: normal;font-size: 18px;line-height: 25px;"><span style="font-size:30px;color:black;">**</span> Please note that Only Travellers <b>who have specifically been vaccinated by the UK NHS and have completed all doses at least 2weeks before travel are considered eligible</b>. Passengers from France MUST undergo Quarantine , Day 2 and 8 tests irrespective of Vaccination Status</p>
            </div>
            
        
        </div>
        <br>
        </div>
        <div class="container">
                <div class="header bg-sky " style="padding:70px">
                    <div class="text-left">
                        <h3 class="text-left">AT A GLANCE GUIDE FOR ARRIVALS TO THE UK FOLLOWING IMPLEMENTATION OF THE'TRAFFIC LIGHT SYSTEM'</h3>
                    </div>
                </div>
            </div>
        
        
        <br>
        <div class="container">
            <div class="table-responsive">
                <div class="visible-xs text-center">
                    <img src="/img/slide_sideways.gif" style="height: 65px">
                </div>
                <table className="font-16">
                    <tr>
                        <th class="bg-white">&nbsp;</th>
                        <th class="bg-1" colspan="3">
                            <div id="child">Children resident in the UK, British Overseas Territories, Channel Islands, Isle of Man, USA or a recognised European country.<br> <br>
                            The recognised European countries are the EU countries, Andorra, Iceland, Liechtenstein, Monaco, Norway, San Marino, Switzerland or the Vatican City</div>
                        </th>
                        <th class="bg-1 text-center" colspan="3"><div id="child">Children resident in other countries</div></th>
                    </tr>
                    <tr>
                        <th class="bg-sky">Ages (years)</th>
                        <th class="bg-2">0 - 4</th>
                        <th class="bg-4">5 - 10</th>
                        <th class="bg-5">11 - 17</th>
                        <th class="bg-2">0 - 4</th>
                        <th class="bg-4">5 - 10</th>
                        <th class="bg-5">11 - 17</th>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="35.5%"><h6>Quarantine (at home or in the place they are staying for 10 days or for the duration of their trip if it’s less than 10 days)</h6> </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="35.5%"><h6>Pre-departure test within 72 hours of travel. </h6></td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="35.5%"><h6>Pre-departure test within 72 hours of travel. </h6></td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="35.5%"><h6>Pre-departure test within 72 hours of travel. </h6></td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                    </tr>
                </table>
                <br>
            </div>
        </div>
</div>
@endsection