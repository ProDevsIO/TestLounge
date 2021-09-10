@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        #generate_button:hover{
            background-color:white;
            color:black !important;
        }
       
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
                <?php $j =1;?>
            @foreach($products as $product)
                <div class="col-xl-4 col-sm-4">
                        <div class="card mb-4 bg-purple" title="Generate voucher">
                            <div class="card-body">
                                <div class="media d-flex align-items-center ">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                        <i class="vl_book"></i>
                                    </div>
                                    <div class="media-body text-light" title="Generate voucher">
                                        <h6 class="text-uppercase mb-0 weight500">{{$product->name}}</h6>
                                        <span>Quota: 
                                            @if($product->voucherCount)
                                            {{$product->voucherCount->quantity}}
                                              @else  
                                              0
                                            @endif</span>
                                            
                                           
                                    </div>
                                    
                                </div>
                                <br>
                                @if($product->voucherCount)
                                    @if($product->voucherCount->quantity > 0)
                                        <button class="btn btn-outline-dark text-white btn-block" id="generate_button" style="color:white; border-color:white;" data-toggle="modal"
                                                                                href="#refmodal{{$product->id}}">generate voucher</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                        <!-- Modal -->

                        <div id="refmodal{{$product->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Assign voucher code to Client</h4>
                                                            <button type="button" class="close pull-left"
                                                                    data-dismiss="modal">&times;
                                                            </button>

                                                        </div>
                                                        <div class="modal-body">
                                                                    <div class="alert alert-warning">
                                                                        <p><span class="badge badge-danger">Notice!</span> Once this code is generated, it will be assigned to this email address and email will be sent out with the booking link for the voucher, This simply means that the code generated can only be used by the assigned email for booking. </p>
                                                                    </div>
                                                            
                                                        
                                                                    <label for=""> Client Email</label>
                                                                    <input type="email" name="email" id="email_{{$j}}"class="form-control">
                                                                    <br>
                                                                    <label for=""> Please select a Quantity</label>
                                                                    <select name="quantity" id="quantity_{{$j}}" class="form-control">
                                                                        
                                                                    @if($product->voucherCount)
                                                                        @for($i=1; $i <= $product->voucherCount->quantity; $i++)
                                                                            <option value="{{$i}}">{{$i}}</option>
                                                                        @endfor
                                                                    @endif
                                                                    </select>
                                                                    
                                                        
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" onclick="sendGenerateData('{{$product->id}}','{{$j}}')" class="btn btn-sm bg-purple text-white">submit</button>
                                                        
                                                            <button type="button" class="btn btn-sm bg-purple text-white"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                      <?php $j++; ?>         
                @endforeach
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
                                                @endif
                                                <th> Assigned</th>
                                                <th scope="col">Voucher Number</th>
                                                <th scope="col" style="padding-left:70px; padding-right:70px">Test package</th>
                                                <!-- <th scope="col">Amount</th> -->
                                                <th scope="col">Quantity</th>
                                                
                                                <th scope="col">Status</th>
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
                                                        @endif
                                                        @if($voucher->email != null)
                                                            <td>{{ $voucher->email }}</td>
                                                         @else
                                                            <td> <span class ="badge badge-warning text-white"> UNASSIGNED</span></td>
                                                        @endif
                                                        <td><a href="/booking/voucher/{{ $voucher->voucher }}">{{ $voucher->voucher }}</a></td>

                                                        <td>{{optional(optional(optional($voucher)->voucherCount)->product)->name}}</td>
                                                        
                            
                                                        
                                                        <td>@if($voucher->quantity == 0)
                                                            Quota has been used up
                                                            @else
                                                            {{ $voucher->quantity }}
                                                            @endif
                                                        </td>
                                                        
                                                        @if($voucher->status == 0)
                                                        <td><span class ="badge badge-warning">Pending </span></td>
                                                        @else
                                                        <td> <span class ="badge badge-success"> Used</span></td>
                                                        @endif
                                                        <td>{{ $voucher->created_at }}</td>
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
        </div>
    </div>
@endsection
@section('script')
    <script src="/assets/vendor/data-tables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/data-tables/dataTables.bootstrap4.min.js"></script>
    <script>

        function sendGenerateData(id, count) {
            var e = 'email_' + count;
            var q = 'quantity_' + count;
            var d = confirm("Are you sure you want to generate a voucher for a client?");
            var email = document.getElementById(e).value;
            var quantity = document.getElementById(q).value;
            // console.log(email, quantity);
            if (d) {

                window.location = '/voucher/email/'+ id + '/' + email + '/' +quantity;
            }
        }


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