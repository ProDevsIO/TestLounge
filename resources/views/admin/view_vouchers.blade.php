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
            <div class="row">
                
                <div class="col-xl-12">
                            <div class="card card-shadow mb-4 ">
                                <div class="card-header border-0">
                                    <div class="custom-title-wrap border-0 position-relative pb-2">
                                        <div class="custom-title">Vouchers</div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    @include('errors.showerrors')
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom" id="data_table">
                                            <thead>
                                            <tr>
                                                @if(auth()->user()->type == 1)
                                                <th> Agent</th>
                                                @elseif(auth()->user()->type == 2)
                                                <th scope="col">Name</th>
                                                @endif
                                                <th scope="col">Voucher Number</th>
                                                <th>Amount</th>
                                                <th>Qauntity</th>
                                                <th>Status</th>
                                                <th scope="col">Date</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                       
                                            @foreach($vouchers as $voucher)
                                            
                                                    <tr>
                                                       
                                                        @if(auth()->user()->type == 1)
                                                            @if(!empty($voucher->user))
                                                            <td>{{ $voucher->user->first_name }} {{ $voucher->user->last_name }}</td>
                                                            @else
                                                            <td> <span class ="badge badge-danger"> Agent NULL</span></td>
                                                            @endif
                                                        @elseif(auth()->user()->type == 2)
                                                            @if(!empty($voucher->user))
                                                                <td>{{ $voucher->user->first_name }} {{$voucher->user->last_name}}</td>
                                                            @else
                                                                <td> <span class ="badge badge-danger"> Agent NULL</span></td>
                                                            @endif
                                                        @endif
                                                        <td>{{ $voucher->transaction_ref }}</td>

                                                        @if(optional($voucher->voucherProduct) == null)
                                                        <td>no record</td>
                                                        @elseif(optional($voucher->voucherProduct)->currency == "NG")
                                                        <td>₦{{ number_format($voucher->voucherProduct->charged_amount) }}</td>
                                                        @else
                                                        <td>£{{ number_format($voucher->voucherProduct->charged_amount) }}</td>
                                                        @endif
                                                        <td>{{ $voucher->quantity }}</td>
                                                        @if($voucher->status == 0)
                                                        <td><span class ="badge badge-warning">Pending </span></td>
                                                        @else
                                                        <td> <span class ="badge badge-success"> Paid</span></td>
                                                        @endif
                                                        <td>{{ $voucher->created_at }}</td>
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
        $(document).ready(function () {
            $('#data_table1').DataTable({
                "order": []
            });
        });
    </script>
@endsection