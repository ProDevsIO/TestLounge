@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/uk_page.css') }}" rel="stylesheet">

@endsection
@section('content')
<header class="title" style="max-height: 300px !important;">
        <div class="background-image-holder parallax-background">
            <img class="background-image" alt="Background Image" src="/img/pass2.jpg">
        </div>
        <div class="container align-bottom">
            <div class="row">
                <div class="col-xs-12 ">

                    <h1 id="cent" class="text-white"></h1>
                </div>
                <br><br>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </header>
<div class="modal show" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title text-center"><b>Choice of Test</b></h4>
        </div>
      
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <center>
                        <a href="/booking/voucher/{{ $voucher }}/yes" style="color:black">
                            <img src="https://img.icons8.com/color/120/000000/walking--v1.png" style="padding:20px"/><br>
                            <button class="btn btn-primary bg-1" href="/walk-in">Walk in</button>
                            <br><br>
                            <p class="text-justify">Do you want to book a walk in?.</p>
                        </a>
                    </center>
                </div>
                <div class="col-md-6 col-sm-6" style="display: block;"> 
                    <center>
                        <a href="/booking/voucher/{{ $voucher }}/" style="color:black">
                        <img style="padding:20px" src="https://img.icons8.com/external-inipagistudio-lineal-color-inipagistudio/120/000000/external-flight-tourist-agency-inipagistudio-lineal-color-inipagistudio.png"/><br>
                        <button class="btn btn-primary bg-1" href="/product/all">Postal</button>
                        <br><br>
                        <p class="text-justify"> Do you want to book a postal?</p>
                        </a>
                    </center>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        
        </div>
      </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#myModal").modal({backdrop: 'static', keyboard: false});
    });
</script>
@endsection