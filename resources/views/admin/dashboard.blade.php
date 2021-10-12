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
        .default_dash {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        .default_dash > .col-xs-4 {
            display: inline-block;
        }
    </style>
@endsection
@section('content')


    <div class="content-wrapper">
        <!----force modal if country not filled in db -->
        <div id="countryForce" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Please update your Country of residence</h5>
                    </div>
                    <div class="modal-body">
                        <small class="text-muted text-danger"> No activites can be conducted on your account until you
                            have updated this requirement *.
                        </small>
                        <form action="{{ url('/update/country') }}" method="post">
                            @csrf
                            <select class="form-control select2 country_id__"
                                    name="country" autocomplete="off"
                                    id="travel_from" onchange="run()" onselect="selectCountry()" required>
                                <option value="">Select a country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->iso }}"
                                            @if(old('country_travelling_from_id') == $country->id)
                                            selected
                                            @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <br>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end of country force modal-->
        <div class="container-fluid">

            @if(auth()->user()->referal_code && !auth()->user()->flutterwave_key)
                <div class="alert alert-danger">
                    Kindly setup your bank account to gain access to your referral link and also recieve payment via voucher payment.<a href="/user/bank"
                                                                                           class="btn btn-danger">Add
                        Bank</a>
                </div>@else
                @if(auth()->user()->type != 1)
                    <div class="alert alert-success">
                        <p>This is your dedicated client booking link . Share this with your clients to make bookings and
                            payments which are tied to the bank account you have provided.Referral
                                Code:<br/><a href="javascript:;"
                                                                                            data-toggle="modal"
                                                                                            data-target="#referralModal"> {{ url('/?ref='.auth()->user()->referal_code) }}</a></p>

                    </div>
                @endif
            @endif
        <!--states start-->
            <div class=" d-block d-sm-none text-center">
                <img src="/img/slide_sideways.gif" style="height: 65px;margin-left: 10px;">
            </div>
            <div class="row default_dash">
                <div class="col-xl-3 col-sm-6 col-xs-4">
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
                <div class="col-xl-3 col-sm-6 col-xs-4">
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
                
                @if(auth()->user()->type == "1")
                    <div class="col-xl-3 col-sm-6 col-xs-4">
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
                    <!-- <div class="col-xl-3 col-sm-6 col-xs-4">
                        <div class="card mb-4 bg-danger">
                            <div class="card-body">
                                <div class="media d-flex align-items-center">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-danger">
                                        <i class="vl_user-male"></i>
                                    </div>
                                    <div class="media-body text-white">
                                        <h4 class="text-uppercase mb-0 weight500">{{ $sub }}</h4>
                                        <span>Sub Agents</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
                        @if(auth()->user()->type == 2)
                        @if(auth()->user()->main_agent_id == null)
                            <!-- <div class="col-xl-3 col-sm-6 col-xs-4">
                                <div class="card mb-4 bg-danger">
                                    <div class="card-body">
                                        <div class="media d-flex align-items-center">
                                            <div class="mr-4 rounded-circle bg-white sr-icon-box text-danger">
                                                <i class="vl_user-male"></i>
                                            </div>
                                            <div class="media-body text-white">
                                                <h4 class="text-uppercase mb-0 weight500">{{ $sub }}</h4>
                                                <span>Sub Agents</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        @endif
                            @if(auth()->user()->country == 'NG' && auth()->user()->id != 55)
                                <div class="col-xl-3 col-sm-6 col-xs-4">
                                    <div class="card mb-4 bg-success">
                                        <div class="card-body" title="Total Credit Transactions minus Expected Earnings">
                                            <div class="media d-flex align-items-center">
                                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-success">
                                                    <i class="vl_money"></i>
                                                </div>
                                                <div class="media-body text-white">
                                                    <h4 class="text-uppercase mb-0 weight500">
                                                        N{{ number_format(auth()->user()->wallet_balance,2) }}</h4>
                                                    <span>Wallet Balance</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-xs-4">
                                    <div class="card mb-4 bg-success">
                                        <div class="card-body" title="Total money paid from Wallet Balance(N)">
                                            <div class="media d-flex align-items-center">
                                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-success">
                                                    <i class="vl_money"></i>
                                                </div>
                                                <div class="media-body text-white">
                                                    <h4 class="text-uppercase mb-0 weight500">
                                                        N{{ number_format($earned,2) }}</h4>
                                                    <span>Expected Earnings</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if(auth()->user()->country == 'NG' && auth()->user()->id != 55)
                                    <div class="col-xl-3 col-sm-6 col-xs-4">
                                        <div class="card mb-4 bg-success">
                                            <div class="card-body" title="Total Credit Transactions minus Expected Earnings">
                                                <div class="media d-flex align-items-center">
                                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-success">
                                                        <i class="vl_money"></i>
                                                    </div>
                                                    <div class="media-body text-white">
                                                        <h4 class="text-uppercase mb-0 weight500">
                                                            $ {{ number_format(auth()->user()->pounds_wallet_balance,2) }}</h4>
                                                        <span> Wallet Balance</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-xs-4">
                                        <div class="card mb-4 bg-success">
                                            <div class="card-body" title="Total money paid from Wallet Balance($)">
                                                <div class="media d-flex align-items-center">
                                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-success">
                                                        <i class="vl_money"></i>
                                                    </div>
                                                    <div class="media-body text-white">
                                                        <h4 class="text-uppercase mb-0 weight500">
                                                            $ {{ number_format($earnedPounds,2) }}</h4>
                                                        <span>Expected Earnings</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif
                       

                    @endif
                    
                @endif
            </div>
            @if(auth()->user()->type == 2)

            @endif

            <!--employee data table-->
            <div class="row">
                <div class="col-xl-12 p-0">
                    <div class="card card-shadow mb-4">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title">Bookings 
                                    
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @include('errors.showerrors')
                            <div class="table-responsive">
                                @if($bookings->count() > 0)
                                    <table class="table table-hover table-custom" id="data_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            @if(auth()->user()->type == 2)
                                                <th scope="col">Phone</th>

                                            @endif
                                            <th scope="col">Email</th>
                                            <th scope="col">Date/Time</th>
                                            <th scope="col" style="padding-left:70px; padding-right:70px">Product
                                                </th>
                                                <th scope="col">Product Price</th>
                                            @if(auth()->user()->type == 1)
                                                
                                                <th scope="col">Commission</th>
                                            @endif
                                            <th scope="col">Status</th>
                                            <th scope="col">Mode of Payment</th>
                                            @if(auth()->user()->referal_code && auth()->user()->id != 55)
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
                                                @if(auth()->user()->type == 2)
                                                    <td>{{ $booking->phone_no }}</td>

                                                @endif
                                                <td>{{ $booking->email }}<br>{{$booking->booking_code}}</td>
                                                <td> {{ $booking->created_at }} </td>
                                                <td><b style="font-size:11px;">
                                                            @foreach($booking->symproduct as $name)
                                                                {{optional(optional($name)->product)->name}} x
                                                                ({{ $name->quantity}})

                                                                <br><br>
                                                            @endforeach
                                                        </b>
                                                    </td>

                                                    @if(isset($booking->product) && $booking->product->currency == "NGN")
                                                        <td> ₦ {{ $booking->product->price }} </td>
                                                    @elseif(isset($booking->product) && $booking->product->currency == "USD")

                                                        <td> $ {{ $booking->product->charged_amount }} </td>
        
                                                    @else
                                                        <td>Product has been deleted</td>
                                                    @endif
                                                    
                                                @if(auth()->user()->type == 1)
                                                   

                                                    @if(isset($booking) && $booking->transaction != null)
                                                        <td>
                                                            ₦ {{ optional($booking->transaction)->amount }} </td>
                                                    @elseif(isset($booking) && $booking->ptransaction != null)
                                                        <td>
                                                            $ {{ optional($booking->ptransaction)->amount }} </td>
                                                    @else
                                                        <td> No Commission</td>
                                                    @endif
                                                @endif
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
                                                    @elseif($booking->mode_of_payment == 3)
                                                        Voucher Payment
                                                    @elseif($booking->mode_of_payment == 4)
                                                        Paystack
                                                    @elseif($booking->mode_of_payment == 5)
                                                        Vas
                                                    @endif
                                                </td>
                                                @if(auth()->user()->referal_code && auth()->user()->id != 55)
                                                    <td> @php
                                                            if($booking->transaction){
                                                                 echo "N".number_format($booking->transaction->amount,2);
                                                            }else if($booking->ptransaction){
                                                                 echo "$".number_format($booking->ptransaction->amount,2);
                                                            }
                                                        @endphp</td>
                                                @endif
                                                @if(auth()->user()->type == "1")
                                                    <td>
                                                        {{ ($booking->vendor) ? $booking->vendor->name : "none" }}
                                                    </td>
                                                    <td>

                                                        {{ ($booking->user) ? $booking->user->first_name." ".$booking->user->last_name : "N/A" }}
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
                                                                <a href="{{ url('/view/booking/'.$booking->id) }}"
                                                                   class="dropdown-item">View</a>
                                                                <a href="{{ url('/booking/delete/'.$booking->id) }}"
                                                                   class="dropdown-item">Delete</a>
                                                                @if($booking->user_id == null)
                                                                    <a class="dropdown-item" data-toggle="modal"
                                                                       href="#refmodal{{$booking->id}}">Add a
                                                                        referral</a>
                                                                @endif
                                                                @if($booking->status == 1)
                                                                    <a href="{{ url('/booking/generate/code/'.$booking->id) }}"
                                                                        class="dropdown-item">Generate booking code</a>
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
                                                            <button type="button" class="close pull-left"
                                                                    data-dismiss="modal">&times;
                                                            </button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/add/referer/'.$booking->id) }}"
                                                                  method="post">
                                                                @csrf
                                                                @if(isset($refs) && !empty($refs))
                                                                    <label for="">Referrers</label>
                                                                    <select name="referal_code" class="form-control"
                                                                            id="" required>
                                                                        <option value="">Select a referer</option>
                                                                        @foreach($refs as $ref)
                                                                            <option value="{{$ref->referal_code}}">{{$ref->first_name}} {{$ref->last_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-sm btn-info">submit
                                                            </button>
                                                            </form>
                                                            <button type="button" class="btn btn-sm btn-info"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                        </tbody>
                                    </table>
                                @else
                                    <div style="padding: 15px">
                                    <div class="alert alert-danger">
                                        @if(auth()->user()->referal_code)
                                            No Booking has been created with your referral link
                                        @else
                                            No Booking has been created
                                        @endif
                                    </div>
                                    </div>
                                @endif
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

                window.location = "/agent/activate/name/" + id;
            }
        }

        function disable(id) {

            var d = confirm("Are you sure you want to hide your name via referral booking?");

            if (d) {

                window.location = "/agent/deactivate/name/" + id;
            }
        }
    </script>
    @if(auth()->user()->type == 2 && auth()->user()->country == null)
        <script>
            $(document).ready(function () {
                $("#countryForce").modal({backdrop: 'static', keyboard: false}, 'show');
            });

        </script>
    @endif
@endsection