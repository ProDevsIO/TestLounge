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
                                    <span>P. Bookings</span>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                               value="{{ (isset($_GET['end']) ? $_GET['start'] : "")  }}" required/>
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
                                    <input type="submit" class="btn btn-danger pull-right mt-2" value="Search">
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
                                <div class="custom-title">Pending Bookings</div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-custom" id="data_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Mode of Payment</th>
                                        @if(auth()->user()->type == "1")
                                            <th scope="col">Vendor</th>
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
                                                {{ $booking->first_name }} {{ $booking->first_name }}
                                            </td>
                                            <td>{{ $booking->phone_no }}</td>
                                            <td>{{ $booking->email }}</td>
                                            <td>@if($booking->status == 0)
                                                    <span class="badge badge-warning">Not Paid</span>
                                                @elseif($booking->status == 1)
                                                    <span class="badge badge-success">Paid</span>
                                                @endif</td>
                                            <td>
                                                @if($booking->mode_of_payment == 1)
                                                    Online
                                                @elseif($booking->mode_of_payment == 2)
                                                    Payment Code
                                                @endif
                                            </td>
                                            @if(auth()->user()->type == "1")
                                                <td>
                                                    {{ ($booking->vendor) ? $booking->vendor->name : "none" }}
                                                </td>
                                                <td><a href="{{ url('/view/booking/'.$booking->id) }}"
                                                       class="btn btn-info">View</a>
                                                </td>
                                            @endif

                                            @if(auth()->user()->vendor_id != "0")
                                                <td><a href="{{ url('/view/booking/'.$booking->id) }}"
                                                       class="btn btn-info">View</a>
                                                </td>
                                            @endif
                                        </tr>
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
                "order": []
            });
        });
    </script>
@endsection