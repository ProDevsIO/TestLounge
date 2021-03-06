@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
       
@endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-sm-3">
                            <div class="card mb-4 bg-dark" title="Total Vendor Cost">
                                <div class="card-body">
                                    <div class="media d-flex align-items-center ">
                                        <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                            <i class="vl_book"></i>
                                        </div>
                                        <div class="media-body text-light" title="Total Vendor Cost">
                                            <h4 class="text-uppercase mb-0 weight500">{{$vouchers->count()}}</h4>
                                            <span>Total Assigned Vouchers</span>
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
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title">Assigned voucher transactions</div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom" id="data_table">
                                            <thead>
                                            <tr>
                                                @if(auth()->user()->type != 1)
                                                <th> Sub Agent</th>
                                                @endif
                                               
                                                <th scope="col" style="padding-left:70px; padding-right:70px">Test package</th>
                                                <th scope> Acquired</th>
                                                <!-- <th scope="col">Amount</th> -->
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <!-- <th scope="col"> Action</th> -->
                                               
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                       
                                                @foreach($vouchers as $voucher)
                                            
                                                        <tr>
                                                        
                                                            @if(auth()->user()->type != 1)
                                                                @if(!empty($voucher->user))
                                                                <td>{{ $voucher->user->first_name }} {{ $voucher->user->last_name }}</td>
                                                                @else
                                                                <td> <span class ="badge badge-danger"> Agent NULL</span></td>
                                                                @endif
                                                            @endif
                                                        
                                                        

                                                            <td>{{optional(optional($voucher)->product)->name}}<br>
                                                            @if($voucher->currency == "NG")
                                                                (N{{$voucher->charged_amount}})
                                                            @else
                                                              (${{$voucher->charged_amount}})
                                                            @endif
                                                            </td>
                                                            @if($voucher->transaction_ref != null)
                                                            <td><span class ="badge badge-info"> Bought</span></td>
                                                            @else
                                                            <td><span class ="badge badge-purple text-white"> Assigned</span></td>
                                                            @endif
                                
                                                            
                                                            <td>@if($voucher->quantity == 0)
                                                                Quota has been used up
                                                                @else
                                                                {{ $voucher->quantity }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                            @if($voucher->currency == "NG")
                                                                N{{$voucher->charged_amount * $voucher->quantity}}
                                                            @else
                                                              ${{$voucher->charged_amount * $voucher->quantity}}
                                                            @endif
                                                               
                                                            </td>
                                                            
                                                            @if($voucher->status == 0)
                                                            <td class="text-center"><span class ="badge badge-warning">Unpaid </span></td>

                                                            @else
                                                            <td> <span class ="badge badge-success"> Paid</span></td>
                                                            @endif
                                                            <td>{{ $voucher->created_at }}</td>
                                                            <!-- @if($voucher->status == 0)
                                                            <td class="text-center"><a href="javascript:;"
                                                                               onclick="confirmation('{{ url('/mark/voucher/' .$voucher->id) }}')"
                                                                               class="bg-success text-white p-2">Mark as paid</a></td>

                                                            @else
                                                            <td> </td>
                                                            @endif -->
                                                            <!-- <td>
                                                                <div class="btn-group" role="group">
                                                                    <button id="btnGroupDrop1" type="button"
                                                                            class="btn btn-primary dropdown-toggle btn-sm"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                    
                                                                        @if($voucher->email == null)
                                                                    
                                                                            <a class="dropdown-item" data-toggle="modal"
                                                                            href="#refmodal{{$voucher->id}}">Send code via email</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td> -->
                                                        </tr>
                                                        
                                                
                                                @endforeach
                                        
                                            </tbody>
                                        </table>
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
        function confirmation(url) {
            var d = confirm("Are you sure you want to perform this action?");

            if (d) {
                window.location = url;
            }
        }
    </script>
@endsection