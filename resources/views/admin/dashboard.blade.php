@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        /* .dataTables_length{
            display:flex;
        }
        .dataTables_filter{
            float:right;
            margin:0;
            padding:0;
        } */
    </style>
@endsection
@section('content')


    <div class="content-wrapper">
        <div class="container-fluid">
        @if(auth()->user()->referal_code && auth()->user()->vendor_id == 0)
        <div class="alert alert-success">
            <p>This is your dedicated client booking link . Share this with your clients to make bookings and payments which are tied to the bank account you have provided.<a href="javascript:;" data-toggle="modal" data-target="#referralModal">Referral
                    Code: {{ url('/booking?ref='.auth()->user()->referal_code) }}</a></p>
                
        </div>
        <div class=" alert alert-warning">
            @if(auth()->user()->agent_show_name == 0)
            If you would like company name to show on the booking page through the referral link, Kindly click the button to enable it.
            <a  class="btn btn-md btn-success text-white" href="javascript:;"  onclick="enable(' {{auth()->user()->id}}')">Enable</a>
           @else
             If you would like company name not to show on the booking page through the referral link, Kindly click the button to disable it.
            <a href="javascript:;"  class="btn btn-md btn-warning  text-white"  onclick="disable('{{auth()->user()->id}}')">Disable</a>
           @endif
        </div>
        @endif
            @if(auth()->user()->referal_code && !auth()->user()->flutterwave_key)
<div class="alert alert-danger">
    Kindly setup your bank account before you start referring. If not your account wouldn't be credited.<a href="/user/bank" class="btn btn-danger">Add Bank</a>
</div>
                @endif
            <!--states start-->
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card mb-4 bg-purple" title="Pending bookings">
                        <div class="card-body">
                            <div class="media d-flex align-items-center ">
                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                    <i class="vl_book"></i>
                                </div>
                                <div class="media-body text-light" title="Pending bookings">
                                    <h4 class="text-uppercase mb-0 weight500">{{ $pending_booking }}</h4>
                                    <span>Unpaid Bookings</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card mb-4 bg-primary" title="Completed bookings">
                        <div class="card-body">
                            <div class="media d-flex align-items-center">
                                <div class="mr-4 rounded-circle bg-white  sr-icon-box text-primary">
                                    <i class="vl_download"></i>
                                </div>
                                <div class="media-body text-white" title="Completed bookings">
                                    <h4 class="text-uppercase mb-0 weight500">{{ $complete_booking }}</h4>
                                    <span>Paid Bookings</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->type == "1")
                    <div class="col-xl-3 col-sm-6">
                        <div class="card mb-4 bg-danger">
                            <div class="card-body">
                                <div class="media d-flex align-items-center">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-danger">
                                        <i class="vl_user-male"></i>
                                    </div>
                                    <div class="media-body text-white">
                                        <h4 class="text-uppercase mb-0 weight500">{{ $users }}</h4>
                                        <span>Users</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-xl-3 col-sm-6">--}}
                        {{--<div class="card mb-4 bg-success">--}}
                            {{--<div class="card-body">--}}
                                {{--<div class="media d-flex align-items-center">--}}
                                    {{--<div class="mr-4 rounded-circle bg-white sr-icon-box text-success">--}}
                                        {{--<i class="vl_money"></i>--}}
                                    {{--</div>--}}
                                    {{--<div class="media-body text-white">--}}
                                        {{--<h4 class="text-uppercase mb-0 weight500">{{ $payment_codes }}</h4>--}}
                                        {{--<span>Payment Codes</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                @else
                    @if(!auth()->user()->vendor_id)
                    <div class="col-xl-3 col-sm-6">
                        <div class="card mb-4 bg-success">
                            <div class="card-body">
                                <div class="media d-flex align-items-center">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-success">
                                        <i class="vl_money"></i>
                                    </div>
                                    <div class="media-body text-white">
                                        <h4 class="text-uppercase mb-0 weight500">
                                            N{{ number_format(auth()->user()->wallet_balance,0) }}</h4>
                                        <span>Total Earnings</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endif
                @endif
            </div>

            <!--employee data table-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title">Bookings</div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                        @include('errors.showerrors')
                            <div class="table-responsive">
                                <table class="table table-hover table-custom" id="data_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Date/Time</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Mode of Payment</th>
                                        @if(auth()->user()->referal_code)
                                            <th scope="col">Earnings</th>
                                        @endif
                                        @if(auth()->user()->type == "1")
                                            <th scope="col">Vendor</th>
                                            <th scope="col">Referral</th>
                                            <th scope="col">Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>
                                                {{ $booking->first_name }} {{ $booking->last_name }}
                                            </td>
                                            <td>{{ $booking->phone_no }}</td>
                                            <td>{{ $booking->email }} <br>{{$booking->booking_code}}</td>
                                            <td> {{ $booking->created_at }} </td>
                                            <td>@if($booking->status == 0)
                                                    <span class="badge badge-warning">Not Paid</span>
                                                @elseif($booking->status == 1)
                                                    <span class="badge badge-success">Paid</span>
                                                @endif</td>
                                            <td>
                                                @if($booking->mode_of_payment == 1)
                                                    Flutterwave
                                                @elseif($booking->mode_of_payment == 2)
                                                    Stripe
                                                @endif
                                            </td>
                                            @if(auth()->user()->referal_code)
                                                <td> @php
                                                    if($booking->transaction){
                                                    echo "N".number_format($booking->transaction->amount,2);
                                                    }
                                                @endphp</td>
                                            @endif
                                            @if(auth()->user()->type == "1")
                                                <td>
                                                    {{ ($booking->vendor) ? $booking->vendor->name : "none" }}
                                                </td>
                                                <td>
                                                    
                                                    {{ ($booking->user) ? $booking->user->first_name." ".$booking->user->last_name : "none" }}
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button"
                                                                class="btn btn-primary dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <a href="{{ url('/view/booking/'.$booking->id) }}" class="dropdown-item">View</a>
                                                            <a href="{{ url('/booking/delete/'.$booking->id) }}" class="dropdown-item">Delete</a>
                                                            @if($booking->user_id == null)
                                                            <a class="dropdown-item" data-toggle="modal" href="#refmodal{{$booking->id}}">Add a referral</a>
                                                            @endif
                                                         </div>
                                                    </div>        
                                                
                                            @endif
                                        </tr>
                                        <!-- Modal -->

                                        <div id="refmodal{{$booking->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Add a referral</h4>
                                                        <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>
                                                        
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('/add/referer/'.$booking->id) }}" method="post">
                                                        @csrf
                                                            @if(isset($refs) && count($refs) > 0 )
                                                        <label for="">Referrers</label>
                                                            <select name="referal_code" class="form-control" id="" required>
                                                                <option value="">Select a referer</option>
                                                                @foreach($refs as $ref)
                                                                     <option value="{{$ref->referal_code}}">{{$ref->first_name}} {{$ref->last_name}}</option>
                                                                @endforeach
                                                            </select>
                                                          @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                            <button type="submit" class="btn btn-sm btn-info">submit</button>
                                                        </form>
                                                        <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--footer-->
    @include('includes.footer ')
    <!--/footer-->
    </div>


@endsection
@section('script')
    <script src="/assets/vendor/data-tables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/data-tables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#data_table').DataTable({
                responsive: true,
                "order": []
            });
        });

        function enable(id) {
            
            var d = confirm("Are you sure you want to display your name via referral booking?");

            if (d) {
                
                window.location = "/agent/activate/name/"+id;
            }
        }
        function disable(id) {
            
            var d = confirm("Are you sure you want to hide your name via referral booking?");

            if (d) {
                
                window.location = "/agent/deactivate/name/"+id;
            }
        }
    </script>
@endsection