@extends('layouts.admin')
@section('style')

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

            @if(auth()->user()->account_no == null)
                @if(auth()->user()->type != 1)
                    <div class="alert alert-danger">
                        Kindly setup your bank account to gain access to your referral link and also recieve payment via
                        voucher payment.<a href="/user/bank"
                                           class="btn btn-danger">Add
                            Bank</a>
                    </div>
                @endif
            @else
                @if(auth()->user()->type != 1)
                    <div class="alert alert-success">
                        <p>This is your dedicated client booking link . Share this with your clients to make bookings
                            and
                            payments which are tied to the bank account you have provided.Referral
                            Code:<br/><a href="javascript:;"
                                         data-toggle="modal"
                                         data-target="#referralModal"> {{ url('/?ref='.auth()->user()->referal_code) }}</a>
                        </p>

                    </div>
            @endif
        @endif
        <!--states start-->
            <div class=" d-block d-sm-none text-center">
                <img src="/img/slide_sideways.gif" style="height: 65px;margin-left: 10px;">
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>

            <div class="row default_dash">
                <div class="col-xl-3 col-sm-6 col-xs-4">
                    <div class="card mb-4" title="Completed bookings">
                        <div class="card-body">
                            <div class="media d-flex align-items-center">
                                <div class="mr-4 rounded-circle bg-white  sr-icon-box text-primary">
                                    <i class="vl_download"></i>
                                </div>
                                <div class="media-body text-white" title="Completed bookings">
                                    <h4 class="text-uppercase mb-0 weight500">{{ $complete_booking }}</h4>
                                    <span class="text-black">Paid Bookings</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-xs-4">
                    <div class="card mb-4 " title="Pending bookings">
                        <div class="card-body">
                            <div class="media d-flex align-items-center ">
                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                    <i class="vl_book"></i>
                                </div>
                                <div class="media-body text-light" title="Pending bookings">
                                    <h4 class="text-uppercase mb-0 weight500">{{ $pending_booking }}</h4>
                                    <span class="text-black">Unpaid Bookings</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(auth()->user()->type == "1")
                    <div class="col-xl-3 col-sm-6 col-xs-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="media d-flex align-items-center">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-danger">
                                        <i class="vl_user-male"></i>
                                    </div>
                                    <div class="media-body text-white">
                                        <h4 class="text-uppercase mb-0 weight500">{{ $users }}</h4>
                                        <span class="text-black">Users</span>
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
                            @if(auth()->user()->country == 'NG' && auth()->user()->id != 55)
                                @if( auth()->user()->main_agent_id != 70)
                                    <div class="col-xl-3 col-sm-6 col-xs-4">
                                        <div class="card mb-4 bg-success">
                                            <div class="card-body"
                                                 title="Total Credit Transactions minus Expected Earnings">
                                                <div class="media d-flex align-items-center">
                                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-success">
                                                        <i class="vl_money"></i>
                                                    </div>

                                                    <div class="media-body text-white">
                                                        <h4 class="text-uppercase mb-0 weight500">
                                                            N{{ number_format(auth()->user()->wallet_balance,2) }}</h4>
                                                        <span>Wallet Balance </span>
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
                                @endif
                            @else
                                @if(auth()->user()->country == 'NG' && auth()->user()->id != 55 )
                                    <div class="col-xl-3 col-sm-6 col-xs-4">
                                        <div class="card mb-4 bg-success">
                                            <div class="card-body"
                                                 title="Total Credit Transactions minus Expected Earnings">
                                                <div class="media d-flex align-items-center">
                                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-success">
                                                        <i class="vl_money"></i>
                                                    </div>
                                                    <div class="media-body text-white">
                                                        <h4 class="text-uppercase mb-0 weight500">
                                                            ${{ number_format(auth()->user()->pounds_wallet_balance,2) }}</h4>
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
                                                            ${{ number_format($earnedPounds,2) }}</h4>
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
                                <div class="table-responsive" style="min-height: 500px">
                                    @if($bookings->count() > 0)
                                        <table class="table table-hover table-custom" id="data_table">
                                            <thead>
                                            <tr>
                                                @if(auth()->user()->type == "1")
                                                    <th scope="col">Action</th>
                                                @endif
                                                <th scope="col">Name</th>
                                                @if(auth()->user()->type == 2)
                                                    <th scope="col">Phone</th>
                                                @endif
                                                <th scope="col">Email</th>
                                                <th scope="col">Date/Time</th>
                                                <th scope="col" style="padding-left:70px; padding-right:70px">Product
                                                </th>
                                                <th scope="col">Product
                                                    Price
                                                </th>
                                                <th scope="col">Status</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bookings as $booking)
                                                <tr>
                                                    @if(auth()->user()->type == "1")

                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button id="btnGroupDrop1" type="button"
                                                                        class="btn btn-primary dropdown-toggle"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    Action
                                                                </button>

                                                                <div class="dropdown-menu"
                                                                     aria-labelledby="btnGroupDrop1">
                                                                    <a href="{{ url('/view/booking/'.$booking->id) }}"
                                                                       class="dropdown-item">View</a>
                                                                    <a href="javascript:;"
                                                                       onclick="confirmation('{{ url('/booking/delete/'.$booking->id) }}')"
                                                                       class="dropdown-item">Delete</a>
                                                                    @if($booking->user_id == null)
                                                                        <a class="dropdown-item" data-toggle="modal"
                                                                           href="#refmodal{{$booking->id}}">Add a
                                                                            referral</a>
                                                                    @endif
                                                                    @if($booking->status == 1)
                                                                        <a href="{{ url('/booking/generate/code/'.$booking->id) }}"
                                                                           class="dropdown-item">Generate booking
                                                                            code</a>
                                                                    @endif
                                                                    @if($booking->dam_location != null)
                                                                    <!-- <a href="#damModal{{$booking->id}}" data-toggle="modal" onclick="getdamlocate('{{ $booking->id }}')" class="dropdown-item">Update Damhealth test location</a> -->
                                                                    @endif
                                                                </div>
                                                            </div>

                                                    @endif
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
                                                        <td> ???{{ $booking->product->price }} </td>
                                                    @elseif(isset($booking->product) && $booking->product->currency == "USD")

                                                        <td> ??{{ $booking->product->charged_amount }} </td>

                                                    @else
                                                        <td>Product has been deleted</td>
                                                    @endif

                                                    <td>@if($booking->status == 0)
                                                            <span class="badge bg-danger rounded-pill">Not Paid</span>
                                                        @elseif($booking->status == 1)
                                                            <span class="badge bg-success rounded-pill">Paid</span>
                                                        @endif</td>



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
                                                                                <option
                                                                                    value="{{$ref->referal_code}}">{{$ref->first_name}} {{$ref->last_name}}</option>
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
                                                <div class="modal fade" id="damModal{{ $booking->id }}" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form
                                                                action="{{ url('/update/damlocation/'.$booking->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                       value="{{ $booking->id }}">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Update lab location</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-md-12">
                                                                        <div id="dam_time" class="form-section"
                                                                             style="margin-top:20px;">
                                                                            <h6>Damhealth Lab location <span
                                                                                    class="show_required text-red"> *</span>
                                                                            </h6>

                                                                            <select
                                                                                class="select-2 form-control get_dam_location"
                                                                                autocomplete="off" name="dam_details"
                                                                                required>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary">Update
                                                                        changes
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @foreach($bookings as $booking)

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

        function confirmation(url) {
            var d = confirm("Are you sure you want to perform this action?");

            if (d) {
                window.location = url;
            }
        }

        function getdamlocate(id) {

            var $el = $(".get_dam_location");
            console.log(id);
            if (id !== '') {

                var url = '/get/damlocation/' + id;

                $.get(url, function (data) {

                    $el.empty(); // remove old options

                    $el.append($("<option value=''>Select an available location </option>"));

                    $.each(data, function (key, value) {

                        console.log(value.array);

                        $el.append($("<option></option>")
                            .attr("value", value.array).text(value.name));
                    });

                });
                console.log('yes');
            } else {
                $el.empty();

                console.log('no');
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
