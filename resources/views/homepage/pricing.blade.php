@extends('layouts.home')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
   
    <style>
      body {
        font-size: 14px;
        font-family: "Inter", sans-serif;
        padding: 0;
        margin: 0;
      }
      .bg-1 {
        background: #2e5c99;
        color: #fff;
      }
      .bg-2 {
        background: #92D050;
        color: #fff;
      }
      .bg-3 {
        background: #FFC000;
        color: #fff;
      }
      .bg-4 {
        background: #E60000;
        color: #fff;
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
        img{
            width:10px;
            margin-left:10px;
        }
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
@endsection
@section('content')

    <div class="main-container">

        <header class="title" style="max-height: 200px !important;">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/hero14.jpg">
            </div>
            
        </header>
        <div class="container">
        <br><br>
            <div class="header shadow curved bg-1 font-30">
                <div><h3 style="color:white; font-weight:300px">AT A GLANCE GUIDE FOR ARRIVALS TO THE UK FOLLOWING IMPLEMENTATION OF THE 'TRAFFIC LIGHT SYSTEM'</h4></div>
                    <div></div>
            
            </div>
            <br><br>
            <table className="font-16 ">
                <thead>
                    <th class="bg-1">MEASURE REQUIRED</th>
                    <th class="bg-2">GREEN</th>
                    <th class="bg-3">AMBER</th>
                    <th class="bg-4">RED</th>
                </thead>
                <tr>
                    <td width="25%">COMPLETE A PASSENGER LOCATOR FORM WITHIN 48 HOURS OF ARRIVAL</td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                </tr>
                <tr>
                    <td width="25%">COMPLETE A PASSENGER LOCATOR FORM WITHIN 48 HOURS OF ARRIVAL</td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                </tr>
                <tr>
                    <td width="25%">COMPLETE A PASSENGER LOCATOR FORM WITHIN 48 HOURS OF ARRIVAL</td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                </tr>
                <tr>
                    <td width="25%">COMPLETE A PASSENGER LOCATOR FORM WITHIN 48 HOURS OF ARRIVAL</td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/close-cross.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                </tr>
            </table>
            <br><br>
        </div>

    </div>

@endsection

