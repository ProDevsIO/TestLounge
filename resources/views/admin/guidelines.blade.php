@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <style>
        h5{
            font-size:20px !important;
            color:red;
        }
    </style>
@endsection
@section('content')
<div class="content-wrapper">
   <div class="container-fluid">
        <div class="row">
            
            <h1>Guidelines</h1>
            
            
            <br><br>
            <div class="col-xl-12 pt-3 card">
                @if($stepper == 1)
                    <h5 for="">Register as an agent on the homepage, fill in your basic information and submit.</h5>
                    <br>
                    <img src="/img/Register.png" class="mx-auto d-block img-fluid" alt="no">
                @elseif($stepper == 2)
                    <h5 for="">You will recieve a mail about your profile being under review, which gets activated by the admin after 24 hours.</h5>
                    <br>
                    <img src="/img/Mail.png" class="mx-auto d-block img-fluid" alt="">
                @elseif($stepper == 3)
                    <h5 for="">On the dashboard, when you login, you get to put in your bank details. With the bank details, you can be able to purchase product vouchers on behalf of your clients. Whenever your account gets credited, you recieve a voucher code which will be used to book a test for the supposed client.</h5>
                    <img src="/img/subagent.png" class="mx-auto d-block img-fluid"  alt="">    
                @elseif($stepper == 4)
                    <h5 for="">To  purchase a voucher, click on “purchase product vouchers” which takes you to a page that a list of products to buy which you do via flutterwave after which your account is then credited. </h5>
                    <br>
                    <img src="/img/purchase product.png" class="mx-auto d-block img-fluid"  alt="">
                    <br>
                    <h5 class="pt-5"for="">After making the necessary transactions and payment, you will be redirected to a voucher’s list where test products purchased and their quotas are displayed.</h5>
                    <br>
                    <img src="/img/voucher list.png" class="mx-auto d-block img-fluid" alt="">
                @elseif($stepper == 5)
                    <h5 for="">As an agent you can also decide to generate vouchers for a client by clicking on the generate button that brings out a modal that tells you to fill in the client’s email and the number of product of that category, an email will be sent to the client telling them that the agent has given them access to the test products. Also attached to the email is a link that the agent or client can fill to confirm payment for the booking that will generate the passenger locator booking codes. Agents can also fill the booking form for clients after generating voucher code by clicking on the voucher number on the page.</h5>
                    <br>
                    <img src="/img/Vouchers.png" class="mx-auto d-block img-fluid" alt="">              
                @elseif($stepper == 6)
                    <h5 for="">As an agent; you get the opportunity to earn 5% each time you purchase a test product for your client. you also have the liberty to have agents under you, and they are called sub-agents. When you register sub-agents under you, you become a super-agent.</h5>
                    <br>
                    <img src="/img/subagents.png" class="mx-auto d-block img-fluid" alt="">    
                @elseif($stepper == 7)
                    <h5 for="">For registration of a sub-agent, the full name, email address, and a percentage share that they are  supposed to get for each booking is filled out by the super-agent and activated on their (super-agent’s) dashboard which sends an auto message to the sub-agents with a link to complete their registration by going to the sign up page to complete registration and login.   </h5>
                   <br>
                    <img src="/img/create subagent account.png" class="mx-auto d-block img-fluid" alt="">
                @endif
            </div>
            
                <div class="col-xl-12 col-sm-12 pt-2">
                    <br>
                    <a class="btn btn-primary btn-md pull-left" href="">{{$stepper}} / 7</a>
                    
                    <div class="btn-group pull-right">
                        @if($stepper > 1)
                        <a class="btn btn-primary btn-md " href="/view/guidelines/{{$stepper - 1}}"><i class="fa fa-angle-left"></i></a>
                        @endif

                        @if($stepper < 7)
                        <a class="btn btn-primary btn-md " href="/view/guidelines/{{$stepper + 1}}"><i class="fa fa-angle-right"></i></a>
                        @endif
                    </div>
                </div>
               
            
        </div>
    </div>
</div>

@endsection
@section('script')
    <script src="/assets/vendor/data-tables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/data-tables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#data_table').DataTable();
        });
    </script>
@endsection