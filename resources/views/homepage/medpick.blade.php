@extends('layouts.home')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <style>
        .iti {
            width: 100%;
        }

        .show_required {
            color: red;
        }
    </style>
@endsection
@section('content')

    <div class="main-container">

        <header class="title" style="max-height: 200px !important;">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/hero14.jpg">
            </div>
            <div class="container align-bottom">
                <div class="row">
                
                </div><!--end of row-->
            </div><!--end of container-->
        </header>

        <section class="feature-selector">
            <div class="container">

            </div>

            <div class="container">
                <ul class="selector-content">
                    <li class="clearfix active">
                        <!-- <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1>A bit about us</h1>
                            </div>
                        </div> -->

                        <div class="row">
                            <form action="https://covid19.medfit.com.ng/consumer/reservation-creator">
                                <div class="col-sm-12"><label for="">To book a test please pick the necessary option below to proceed</label></div>
                                
                            <div class="col-sm-12" style="margin-top: 30px">
                                   <label>Country <span class="show_required"> *</span></label>
                                            <select class="form-control" id="" name="" required>
                                                <option value="">Make a selection</option>
                                                <option value="">Nigeria</option>
                                            </select>
                                           
                            </div>
                            
                            <div class="col-sm-12" style="margin-top: 30px">
                                  <label>Test Center <span class="show_required"> *</span></label>
                                           <input type="text" class="form-control" value = "Medbury medicals " readonly>
                            </div>

                            <button  type="submit" class="btn btn-primary pull-right" style="margin-top: 30px" >Next </button>
                            </form>
                        </div><!--end of row-->
                    </li><!--end of individual feature content-->


                </ul>
            </div>
        </section>



    </div>

@endsection

