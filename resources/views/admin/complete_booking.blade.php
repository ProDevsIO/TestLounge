@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')


    <div class="content-wrapper">
        <div class="container-fluid">

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
                                    <h4 class="text-uppercase mb-0 weight500">{{ $bookings->count() }}</h4>
                                    <span>C. Bookings</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->type == 1)
                        @if($ven != null)
                            <div class="card mb-4 bg-purple" title="Pending bookings">
                                <div class="card-body">
                                    <div class="media d-flex align-items-center ">
                                        <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                            <i class="vl_money"></i>
                                        </div>
                                        <div class="media-body text-light" title="Pending bookings">
                                            <h4 class="text-uppercase mb-0 weight500">
                                                £ {{ number_format($vendorsTotalCost) }}</h4>
                                            <span>{{$ven->vendor->name}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="col-xl-9 col-sm-6">
                    <div class="card mb-4 bg-primary" title="Completed bookings">
                        <div class="card-body">
                            <h3>Filter</h3>

                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Start Date</label>
                                        <input type="date" name="start" class="form-control"
                                               value="{{ (isset($_GET['start']) ? $_GET['start'] : "")  }}" required/>
                                    </div>
                                    <div class="col-md-6">
                                        <label>End Date</label>
                                        <input type="date" name="end" class="form-control"
                                               value="{{ (isset($_GET['end']) ? $_GET['end'] : "")  }}" required/>
                                    </div>
                                    @if(auth()->user()->type == 1)
                                        <div class="col-md-6">
                                            <label>Vendors</label>
                                            <select name="vendor_id" class="form-control">
                                                <option value="">Select a Vendor</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}" {{ ((isset($_GET['vendor_id']) && ($_GET['vendor_id'] == $vendor->id) ) ? "selected" : "")  }} >{{ $vendor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Referral</label>
                                            <select name="user_id" class="form-control">
                                                <option value="">Select a Referal</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ ((isset($_GET['user_id']) && ($_GET['user_id'] == $user->id) ) ? "selected" : "")  }} >{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Products</label>
                                            <select name="product_id" class="form-control">
                                                <option value="">Select a Product</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" {{ ((isset($_GET['product_id']) && ($_GET['product_id'] == $product->id) ) ? "selected" : "")  }} >{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    @if(auth()->user()->vendor_id != 0)
                                        <div class="col-md-12">
                                            <label>Products</label>
                                            <select name="product_id" class="form-control">
                                                <option value="">Select a Product</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" {{ ((isset($_GET['product_id']) && ($_GET['product_id'] == $product->id) ) ? "selected" : "")  }} >{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div style="width: 100%">
                                        <input type="submit" class="btn btn-danger pull-right mt-2" style="margin-left: 15px;" value="Search">
                                        @if(auth()->user()->type == 1)
                                            <input type="submit" class="btn btn-warning pull-left mt-2"  name="export"
                                                   style="margin-left: 20px" value="Export">
                                        @endif
                                    </div>
                                    @csrf
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!--employee data table-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title">Completed Bookings</div>
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
                                            @if(auth()->user()->vendor_id != "0")
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
                                                <td>{{ $booking->email }}<br/>
                                                    @if(auth()->user()->type == "1")
                                                        <ul>
                                                            <li>{{ optional(optional($booking->product)->product)->name }}
                                                                ({{ optional($booking->product)->currency.number_format(optional($booking->product)->charged_amount,2)}}
                                                                )
                                                            </li>
                                                        </ul>
                                                        <br/>
                                                        @if($booking->booking_code)
                                                            Reference Code: {{ $booking->booking_code }}
                                                        @endif
                                                    @endif
                                                </td>

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
                                                                echo "₦".number_format($booking->transaction->amount,2);
                                                            }elseif($booking->ptransaction){
                                                                echo "£".number_format($booking->ptransaction->amount,2);
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
                                                                <a href="{{ url('/view/booking/'.$booking->id) }}"
                                                                   class="dropdown-item">View</a>
                                                                <a href="{{ url('/booking/delete/'.$booking->id) }}"
                                                                   class="dropdown-item">Delete</a>
                                                                <a href="javascript:;" data-toggle="modal"
                                                                   data-target="#editEmail{{ $booking->id }}"
                                                                   class="dropdown-item">Edit Email</a>
                                                                <a href="javascript:;"
                                                                   onclick="resendReceipt('{{ $booking->id }}')"
                                                                   class="dropdown-item">Resend Receipt</a>
                                                                @if($booking->user_id == null)
                                                                    <a class="dropdown-item" data-toggle="modal"
                                                                       href="#refmodal{{$booking->id}}">Add a
                                                                        referral</a>
                                                                @endif
                                                            </div>
                                                        </div>


                                                    </td>
                                                @endif

                                                @if(auth()->user()->vendor_id != "0")
                                                    <td><a href="{{ url('/view/booking/'.$booking->id) }}"
                                                           class="btn btn-info">View</a>
                                                        <a href="{{ url('/send/booking/'.$booking->id) }}"
                                                           class="btn btn-info">Send to Logistics Company</a>
                                                    </td>
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
                                                                <label for="">Referrers</label>
                                                                <select name="referal_code" class="form-control" id=""
                                                                        required>
                                                                    <option value="">Select a referer</option>
                                                                    @foreach($refs as $ref)
                                                                        <option value="{{$ref->referal_code}}">{{$ref->first_name}} {{$ref->last_name}}</option>
                                                                    @endforeach
                                                                </select>

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


                                            <!-- Modal -->
                                            <div class="modal fade" id="editEmail{{ $booking->id }}" tabindex="-1"
                                                 role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ url('edit/email') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $booking->id }}">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    Email</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="email" name="email"
                                                                       value="{{ $booking->email }}"
                                                                       class="form-control"/>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes
                                                                </button>
                                                            </div>
                                                        </form>
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
                "order": []
            });
        });

        function resendReceipt(id) {
            var d = confirm("Are you sure you want to resend the receipt?");
            if (d) {
                window.location = "/resend/receipt/" + id;
            }
        }
    </script>
@endsection