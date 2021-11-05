@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">


            <!--employee data table-->
            <div class="row">
                
                <div class="col-xl-12 p-0">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title pull-left">
                                 
                                           @if($currency == 'naira')
                                            Profit(Naira)
                                            @elseif($currency == 'dollars')
                                            Profit(Dollars)
                                            @elseif($currency == 'cedis')
                                            Total Revenue(Ghana cedis)
                                            @elseif($currency == 'tzs')
                                            Total Revenue(Tanzanian Shilling)
                                            @elseif($currency == 'kes')
                                            Total Revenue(Kenyan Shilling)
                                            @elseif($currency == 'zar')
                                            Total Revenue(South African Rand) 
                                            @endif
                                </div>
                                <!-- <div class="pull-right"> <a href="{{ url('/currency/export/'.$currency.'/'.$startDate .'/'. $endDate) }}" class="btn btn-md btn-warning text-white">Export</a></div>
                                   -->
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @include('errors.showerrors')
                            <div class="table-responsive">
                                <table class="table table-hover table-custom" id="data_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Agent</th>
                                        <th scope="col">Vendor</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Selling Price</th>
                                        <th scope="col">Vendor's Cost Price</th>
                                        <th scope="col">Commission</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($currency == 'naira')
                                        @foreach($transact as $transact)
                                            @if($transact->product)
                                                @if($transact->product_ngn)
                                                    <tr>
                                                        <td>
                                                        {{ $transact->first_name }}   {{ $transact->last_name }}
                                                        </td>
                                                        <td>{{ optional(optional($transact)->user)->first_name }} {{ optional(optional($transact)->user)->last_name }}</td>
                                                        <td> {{optional(optional($transact)->vendor)->name}}</td>
                                                        <td>
                                                            {{optional(optional(optional($transact)->product)->product)->name}}
                                                        </td>
                                                        <td>
                                                            {{optional(optional($transact)->product)->quantity}}
                                                        </td>
                                                        <td>
                                                            @if($currency == 'naira')
                                                        
                                                            N{{ number_format(optional(optional($transact)->product)->charged_amount, 2) }}
                                                            @elseif($currency == 'dollars')
                                                            ${{ number_format(optional(optional($transact)->product)->charged_amount, 2) }}</td>
                                                            @endif
                                                        </td>
                                                        <td>
                                                        @if($currency == 'naira')
                                                        <?php

                                                        $Exchange_rate =   optional(optional($transact)->product)->price /  (optional(optional($transact)->product)->price_pounds ?? 1);
                                                        $value = optional(optional($transact)->product)->vendor_cost_price * $Exchange_rate;
                                                        ?>
                                                        N{{ number_format($value, 2) }}
                                                        @elseif($currency == 'dollars')
                                                        ${{ number_format(optional(optional($transact)->product)->vendor_cost_price, 2) }} </td>
                                                        @endif
                                                        </td>
                                                        <td>
                                                            N{{$transact->transaction->amount ?? 0}}
                                                        </td>
                                                        @if($currency == 'naira')
                                                                
                                                            @if( optional(optional($transact)->product)->charged_amount >= $value  + ($transact->ptransaction->amount ?? 0))
                                                                <td class="text-success">N{{ optional(optional($transact)->product)->charged_amount -  $value - ($transact->transaction->amount ?? 0) }}
                                                            @else
                                                            <td class="text-danger">N{{ optional(optional($transact)->product)->charged_amount -  $value - ($transact->transaction->amount ?? 0)}}
                                                            @endif
                                                        @elseif($currency == 'dollars')
                                                            @if( optional(optional($transact)->product)->charged_amount >= (optional(optional(optional($transact)->booking)->product)->vendor_cost_price  + $transact->amount))   
                                                                <td class="text-success">${{ optional(optional($transact)->product)->charged_amount -  optional(optional($transact)->product)->vendor_cost_price  }} 
                                                            @else
                                                            <td class="text-danger">${{ optional(optional($transact)->product)->charged_amount -  optional(optional($transact)->product)->vendor_cost_price}}
                                                            @endif
                                                        @endif
                                                        <td>{{$transact->created_at}}</td>
                                                    </tr>
                                                @endif
                                            @endif                                       
                                        @endforeach
                                    @endif

                                    @if($currency == 'dollars')
                                        @foreach($transact as $transact)
                                            @if($transact->product)
                                                @if($transact->product_usd)
                                                    <tr>
                                                        <td>
                                                        {{ $transact->first_name }}   {{ $transact->last_name }}
                                                        </td>
                                                        <td>{{ optional(optional($transact)->user)->first_name }} {{ optional(optional($transact)->user)->last_name }}</td>
                                                        <td> {{optional(optional($transact)->vendor)->name}}</td>
                                                        <td>
                                                            {{optional(optional(optional($transact)->product)->product)->name}}
                                                        </td>
                                                        <td>
                                                            {{optional(optional($transact)->product_usd)->quantity}}
                                                        </td>
                                                        <td>
                                                            @if($currency == 'naira')
                                                        
                                                            N{{ number_format(optional(optional($transact)->product_usd)->charged_amount, 2) }}
                                                            @elseif($currency == 'dollars')
                                                            ${{ number_format(optional(optional($transact)->product_usd)->charged_amount, 2) }}</td>
                                                            @endif
                                                        </td>
                                                        <td>
                                                        @if($currency == 'naira')
                                                        <?php

                                                        $Exchange_rate =   optional(optional($transact)->product_usd)->price /  (optional(optional($transact)->product_usd)->price_pounds ?? 1);
                                                        $value = optional(optional($transact)->product_usd)->vendor_cost_price * $Exchange_rate;
                                                        ?>
                                                        N{{ number_format($value, 2) }}
                                                        @elseif($currency == 'dollars')
                                                        ${{ number_format(optional(optional($transact)->product_usd)->vendor_cost_price, 2) }} </td>
                                                        @endif
                                                        </td>
                                                         <td>
                                                            ${{$transact->ptransaction->amount ?? 0}}
                                                        </td>
                                                        @if($currency == 'naira')
                                                                
                                                            @if( optional(optional($transact)->product_usd)->charged_amount >= $value  + ($transact->ptransaction->amount ?? 0))
                                                                <td class="text-success">N{{ optional(optional($transact)->product_usd)->charged_amount -  $value - ($transact->ptransaction->amount ?? 0)}}
                                                            @else
                                                            <td class="text-danger">N{{ optional(optional($transact)->product_ngn)->charged_amount -  $value - ($transact->ptransaction->amount ?? 0) }}
                                                            @endif
                                                        @elseif($currency == 'dollars')
                                                            @if( optional(optional($transact)->product)->charged_amount >= (optional(optional($transact)->product)->vendor_cost_price  + ($transact->ptransaction->amount ?? 0)))   
                                                                <td class="text-success">${{ optional(optional($transact)->product)->charged_amount -  optional(optional($transact)->product)->vendor_cost_price - ($transact->ptransaction->amount ?? 0) }} 
                                                            @else
                                                            <td class="text-danger">${{ optional(optional($transact)->product)->charged_amount -  optional(optional($transact)->product)->vendor_cost_price - ($transact->ptransaction->amount ?? 0)}}
                                                            @endif
                                                        @endif
                                                        <td>{{$transact->created_at}}</td>
                                                    </tr>
                                                @endif
                                            @endif                                       
                                        @endforeach
                                    @endif


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