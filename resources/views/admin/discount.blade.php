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
                                   <span>Total Discount Transaction</span>
                               </div>
                           </div>
                       </div>
                   </div>
           </div>
         </div>

         <div class="row">
             <div class="col-xl-12">
                 <div class="card">
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
                                                    <th scope="col">Discount Amount</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Date</th>
                                                    
                                                
                                                    <!-- <th scope="col">Action</th> -->
                                                </tr>
                                                </thead>
                                                <tbody>
                                        
                                                    @foreach($vouchers as $voucher)
                                                       @if(!empty($voucher->v_pay))
                                                            <tr>
                                                            
                                                                @if(auth()->user()->type == 1)
                                                                    @if(!empty($voucher->v_pay))
                                                                    <td>{{ $voucher->v_pay->user->first_name }} {{ $voucher->v_pay->user->last_name }}</td>
                                                                    @else
                                                                    <td> <span class ="badge badge-danger"> Agent NULL</span></td>
                                                                    @endif
                                                                @endif
                                                            
                                                            

                                                                <td>{{optional(optional($voucher->v_pay)->product)->name}}<br>
                                                                @if($voucher->currency == "NG")
                                                                    @if($voucher->v_pay->transaction_ref != null)
                                                                        (N{{$voucher->cost_config }})
                                                                    @else
                                                                      (N{{$voucher->cost_config * $voucher->v_pay->quantity}})
                                                                    @endif
                                                                    
                                                                @else
                                                                     @if($voucher->v_pay->transaction_ref != null)
                                                                        (${{$voucher->cost_config}})
                                                                    @else
                                                                      (${{$voucher->cost_config * $voucher->v_pay->quantity}})
                                                                    @endif
                                                                
                                                                @endif
                                                                </td>
                                                                @if($voucher->v_pay->transaction_ref != null)
                                                                <td><span class ="badge badge-info"> Bought</span></td>
                                                                @else
                                                                <td><span class ="badge badge-purple text-white"> Assigned</span></td>
                                                                @endif
                                    
                                                                
                                                                <td>
                                                                    {{ $voucher->v_pay->quantity }}
                                                                    
                                                                </td>
                                                                <td>
                                                                @if($voucher->currency == "NG")
                                                                    N  {{$voucher->amount}}
                                                                @else
                                                                $  {{$voucher->amount}}
                                                                @endif
                                                                
                                                                
                                                                </td>
                                                                
                                                                @if($voucher->v_pay->status == 0)
                                                                <td><span class ="badge badge-warning">unpaid </span></td>
                                                                @else
                                                                <td> <span class ="badge badge-success"> Paid</span></td>
                                                                @endif


                                                                <td>{{ $voucher->created_at }}</td>
                                                                
                                                                
                                                            </tr>
                                                        @endif    
                                                    
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
            $('#data_table').DataTable();
        });
    </script>
@endsection