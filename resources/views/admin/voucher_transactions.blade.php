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
                                   <h4 class="text-uppercase mb-0 weight500">{{$voucher_all->count()}}</h4>
                                   <span>Total Transactions</span>
                               </div>
                           </div>
                       </div>
                   </div>
           </div>
           <div class="col-xl-3 col-sm-3">
                <div class="card mb-4 bg-info" title="Total Vendor Cost">
                       <div class="card-body">
                           <div class="media d-flex align-items-center ">
                               <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                   <i class="vl_book"></i>
                               </div>
                               <div class="media-body text-light" title="Total Vendor Cost">
                                   <h4 class="text-uppercase mb-0 weight500">{{$voucherpaid}}</h4>
                                   <span>Paid Transactions</span>
                               </div>
                           </div>
                       </div>
                   </div>
           </div>
           <div class="col-xl-3 col-sm-3">
                <div class="card mb-4 bg-danger" title="Total Vendor Cost">
                       <div class="card-body">
                           <div class="media d-flex align-items-center ">
                               <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                   <i class="vl_book"></i>
                               </div>
                               <div class="media-body text-light" title="Total Vendor Cost">
                                   <h4 class="text-uppercase mb-0 weight500">{{$voucherunpaid}}</h4>
                                   <span>unpaid Transactions</span>
                               </div>
                           </div>
                       </div>
                   </div>
           </div>
         </div>
        <div class="row">
                <div class="col-xl-12 container p-0">
                    <ul class="nav nav-tabs nav-justified ">
                    
                        <li class="nav-item active">
                            <a class="nav-link active" data-toggle="tab" href="#home">Assigned vouchers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Bought vouchers</a>
                        </li>
                       
                   
                    </ul>
                </div>
             <div class="tab-content" style="width:100%">
                <div id="home" class="col-xl-12 p-0 tab-pane active">
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
                                                @if(auth()->user()->type == 1)
                                                <th> Agent</th>
                                                @endif
                                               
                                                <th scope="col" style="padding-left:70px; padding-right:70px">Test package</th>
                                                <th scope> Acquired</th>
                                                <!-- <th scope="col">Amount</th> -->
                                                
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Product Price</th>
                                                <th>Discount</th>
                                                <th scope="col">Amount Paid</th>
                                               
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                @if(auth()->user()->type == 1)
                                                <th scope="col"> Action</th>
                                                @endif
                                               
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                       
                                                @foreach($voucherboughts as $voucher)
                                            
                                                        <tr>
                                                        
                                                            @if(auth()->user()->type == 1)
                                                                @if(!empty($voucher->user))
                                                                <td>{{ $voucher->user->first_name }} {{ $voucher->user->last_name }}</td>
                                                                @else
                                                                <td> <span class ="badge badge-danger"> Agent NULL</span></td>
                                                                @endif
                                                            @endif
                                                        
                                                        

                                                            <td> {{optional(optional($voucher)->product)->name}}<br>
                                                           
                                                            </td>
                                                            @if($voucher->transaction_ref != null)
                                                            <td><span class ="badge badge-info"> Bought</span></td>
                                                            @else
                                                            <td><span class ="badge badge-purple text-white"> Assigned</span></td>
                                                            @endif
                                
                                                            
                                                            <td>
                                                              
                                                                {{ $voucher->quantity }}
                                                                
                                                            </td>
                                                            <td>
                                                                @if($voucher->currency == "NG")
                                                                N{{($voucher->charged_amount + (optional($voucher->discount)->amount / ($voucher->quantity ?? 1))) * ($voucher->quantity ?? 1)}}
                                                                @else
                                                                ${{$voucher->charged_amount + (optional($voucher->discount)->amount / ($voucher->quantity ?? 1))}}
                                                                @endif
                                                            </td>
                                                            <td>
                                                            @if($voucher->currency == "NG")
                                                             N {{optional($voucher->discount)->amount ?? 0 }}
                                                            @else
                                                            $  {{optional($voucher->discount)->amount }}
                                                            @endif
                                                            </td>
                                                            <td>
                                                                 @if($voucher->currency == "NG")
                                                                N{{$voucher->charged_amount * ($voucher->quantity ?? 1)}}
                                                                @else
                                                                ${{$voucher->charged_amount * ($voucher->quantity ?? 1)}}
                                                                @endif
                                                            </td>
                                                            

                                                            
                                                            @if($voucher->status == 0)
                                                            <td class="text-center"><span class ="badge badge-warning">Unpaid </span></td>

                                                            @else
                                                            <td> <span class ="badge badge-success"> Paid</span></td>
                                                            @endif
                                                            <td>{{ $voucher->created_at }}</td>
                                                            @if($voucher->status == 0 && auth()->user()->type == 1)
                                                            <td class="text-center"><a href="javascript:;"
                                                                               onclick="confirmation('{{ url('/mark/voucher/' .$voucher->id) }}')"
                                                                               class="bg-success text-white p-2">Mark as paid</a></td>

                                                            @else
                                                            
                                                            @endif
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
                
                <div id="menu1" class="col-xl-12 p-0 tab-pane fade" style="width:100%"> 
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title">Bought voucher transactions</div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom" id="data_table1">
                                            <thead>
                                            <tr>
                                                @if(auth()->user()->type == 1)
                                                <th> Agent</th>
                                                @endif
                                               
                                                <th scope="col" style="padding-left:70px; padding-right:70px">Test package</th>
                                                <th scope> Acquired</th>
                                                <!-- <th scope="col">Amount</th> -->
                                                
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Product Price</th>
                                                <th>Discount</th>
                                                <th scope="col">Amount Paid</th>
                                                <th scope="col">Super Agent share</th>
                                                <th scope ="col"  style="padding-left:50px; padding-right:50px">Percentage</th>
                                                
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                @if(auth()->user()->id == 1)
                                                <th scope="col"> Action</th>
                                                @endif
                                               
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
                                                        
                                                        

                                                            <td>{{optional(optional($voucher)->product)->name}}<br>
                                                                @if($voucher->currency == "NG")
                                                                     N {{$voucher->o_price / ($voucher->quantity ?? 1)}}
                                                                @else
                                                                     $  {{$voucher->o_price / ($voucher->quantity ?? 1)}}
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
                                                                    N  {{$voucher->charged_amount + optional($voucher->discount)->amount}}
                                                                @else
                                                                $  {{$voucher->charged_amount + optional($voucher->discount)->amount}}
                                                                @endif
                                                            
                                                               
                                                            </td>
                                                            <td>
                                                                @if($voucher->currency == "NG")
                                                                N {{optional($voucher->discount)->amount ?? 0 }}
                                                                @else
                                                                $  {{optional($voucher->discount)->amount }}
                                                                @endif
                                                                <br>
                                                                ({{ ((optional($voucher->discount)->amount ?? 0) * 100 ) / ($voucher->charged_amount +  (optional($voucher->discount)->amount ?? 0)) }} % )
                                                                
                                                            </td>
                                                            
                                                            <td>
                                                                @if($voucher->currency == "NG")
                                                                    N  {{$voucher->charged_amount}}
                                                                @else
                                                                $  {{$voucher->charged_amount}}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($voucher->currency == "NG")
                                                                    @if($voucher->super_agent_share == 0)
                                                                        none
                                                                    @else
                                                                    N  {{$voucher->super_agent_share}}
                                                                    @endif
                                                                
                                                                @else
                                                                    @if($voucher->super_agent_share == 0)
                                                                        none
                                                                    @else
                                                                    $  {{$voucher->super_agent_share}}
                                                                    @endif
                                                                
                                                                @endif
                                                            </td>
                                                            <td>
                                                            @if($voucher->status != 0)
                                                                Discount ({{ number_format(((optional($voucher->discount)->amount ?? 0) * 100 ) / ($voucher->charged_amount +  (optional($voucher->discount)->amount ?? 0))) }} % ) <br>
                                                               
                                                                Super agent({{  number_format((($voucher->super_agent_share) * 100 ) / ($voucher->charged_amount +  (optional($voucher->discount)->amount ?? 0))) }} % )<br>
                                                                Sub agent ({{ number_format((($voucher->sub_agent_share) * 100 ) / ($voucher->charged_amount +  (optional($voucher->discount)->amount ?? 0))) }} % )
                                                                
                                                            @endif
                                                            </td>
                                                           

                                                            @if($voucher->status == 0)
                                                            <td><span class ="badge badge-warning">unpaid </span></td>
                                                            @else
                                                            <td> <span class ="badge badge-success"> Paid</span></td>
                                                            @endif
                                                            <td>{{ $voucher->created_at }}</td>
                                                            @if(auth()->user()->id == 1)
                                                            <td>
                                                            
                                                                @if($voucher->status == 0)
                                                                <a href="{{ url('/voucher/payment/confirmation?trxref='.$voucher->transaction_ref) }}" class="btn btn-sm btn-info"> check payment</a>
                                                                @endif
                                                            </td>
                                                            @endif
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