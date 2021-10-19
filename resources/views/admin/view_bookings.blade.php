@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="content-wrapper">
        <div class="container-fluid">
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
                                @if($booking_products->count() > 0)
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
                                               
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($booking_products as $booking_product)
                                            <tr>
                                                <td>
                                                    {{ optional(optional($booking_product)->booking)->first_name }} {{optional(optional($booking_product)->booking)->last_name }}
                                                </td>
                                                @if(auth()->user()->type == 2)
                                                    <td>{{optional(optional($booking_product)->booking)->phone_no }}</td>

                                                @endif
                                                <td>{{optional(optional($booking_product)->booking)->email }}<br>{{$booking_product->booking->booking_code}}</td>
                                                <td> {{optional(optional($booking_product)->booking)->created_at }} </td>
                                                <td><b style="font-size:11px;">
                                                            @foreach($booking_product->booking->symproduct as $name)
                                                                {{optional(optional($name)->product)->name}} x
                                                                ({{ $name->quantity}})

                                                                <br><br>
                                                            @endforeach
                                                        </b>
                                                    </td>

                                                    @if( $booking_product->currency == "NGN")
                                                        <td> ₦{{ $booking_product->price }} </td>
                                                    @elseif($booking_product->currency == "USD")

                                                        <td> ${{ $booking_product->charged_amount }} </td>
        
                                                    @else
                                                        <td>Product has been deleted</td>
                                                    @endif
                                                    
                                                @if(auth()->user()->type == 1)
                                                   

                                                    @if(isset($booking_product->booking) && optional(optional($booking_product)->booking)->transaction != null)
                                                        <td>
                                                            ₦{{ optional($booking_product->booking->transaction)->amount }} </td>
                                                    @elseif(isset($booking_product->booking) &&optional(optional($booking_product)->booking)->ptransaction != null)
                                                        <td>
                                                            ${{ optional($booking_product->booking->ptransaction)->amount }} </td>
                                                    @else
                                                        <td> No Commission</td>
                                                    @endif
                                                @endif
                                                <td>@if($booking_product->booking->status == 0)
                                                        <span class="badge badge-warning">Not Paid</span>
                                                    @elseif($booking_product->booking->status == 1)
                                                        <span class="badge badge-success">Paid</span>
                                                    @endif</td>
                                                <td>
                                                    @if($booking_product->booking->mode_of_payment == 1)
                                                        Flutterwave
                                                    @elseif($booking_product->booking->mode_of_payment == 2)
                                                        Stripe
                                                    @elseif($booking_product->booking->mode_of_payment == 3)
                                                        Voucher Payment
                                                    @elseif($booking_product->booking->mode_of_payment == 4)
                                                        Paystack
                                                    @elseif($booking_product->booking->mode_of_payment == 5)
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
                                                        {{ ($booking_product->booking->vendor) ?optional(optional($booking_product)->booking)->vendor->name : "none" }}
                                                    </td>
                                                    <td>

                                                        {{ ($booking_product->booking->user) ?optional(optional($booking_product)->booking)->user->first_name." ".$booking_product->booking->user->last_name : "N/A" }}
                                                    </td>
                                                   

                                                @endif
                                            </tr>
                                            <!-- Modal -->

                                           
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