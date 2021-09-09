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
                                                <th scope="col">Product</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">type</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Action</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                       
                                            @foreach($vouchers as $voucher)
                                                @if($voucher->status != 0)
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

                                                        <td>{{optional(optional(optional($voucher)->voucherProduct)->product)->name}}</td>
                                                        
                                                            @if(optional($voucher->voucherProduct)->currency == "NG")
                                                            <td>₦{{ number_format(optional($voucher->voucherProduct)->charged_amount) }}</td>
                                                            @else
                                                            <td>£{{ number_format(optional($voucher->voucherProduct)->charged_amount) }}</td>
                                                            @endif
                                                        
                                                        <td>@if($voucher->quantity == 0)
                                                            Quota has been used up
                                                            @else
                                                            {{ $voucher->quantity }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($voucher->type == 1)
                                                            <span class ="badge badge-success"> Family/Group plan</span>
                                                            @elseif($voucher->typ == 2)
                                                            <span class ="badge badge-success"> Individual plan</span>
                                                            @else
                                                            <span class ="badge badge-danger">Invalid</span>
                                                            @endif
                                                        </td>
                                                        @if($voucher->status == 0)
                                                        <td><span class ="badge badge-warning">Pending </span></td>
                                                        @else
                                                        <td> <span class ="badge badge-success"> Paid</span></td>
                                                        @endif
                                                        <td>{{ $voucher->created_at }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button id="btnGroupDrop1" type="button"
                                                                        class="btn btn-primary dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                   
                                                                    @if($voucher->quantity == null)
                                                                        <a class="dropdown-item" data-toggle="modal"
                                                                        href="#refmodal{{$voucher->id}}">Send code via email</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                   <!-- Modal -->

                                            <div id="refmodal{{$voucher->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Email voucher code to Client</h4>
                                                            <button type="button" class="close pull-left"
                                                                    data-dismiss="modal">&times;
                                                            </button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/voucher/email/'.$voucher->id) }}"
                                                                  method="post">
                                                                @csrf
                                                        
                                                                    <label for=""> Client Email</label>
                                                                    <input type="email" name="email" class="form-control">
                                                                    
                                                        
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