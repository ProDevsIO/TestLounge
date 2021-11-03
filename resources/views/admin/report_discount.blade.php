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
                                            Discount(Naira)
                                            @elseif($currency == 'dollar')
                                            Discount(Dollars)
                                            @endif
                                </div>
                               
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @include('errors.showerrors')
                            <div class="table-responsive">
                                <table class="table table-hover table-custom" id="data_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Agent</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Discount amount</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($discounts as $discount)
                                      
                                        <tr>
                                            <td> {{optional(optional(optional($discount)->user)->superAgent)->first_name}} {{optional(optional(optional($discount)->user)->superAgent)->last_name}} </td>
                                            <td>{{optional(optional($discount)->product)->name}}</td>
                                            <td>{{ $discount->quantity }}</td>
                                            <td>
                                            @if($currency == 'naira')    
                                             N {{ $discount->super_agent_share }}
                                            @else
                                            $ {{ $discount->super_agent_share }}
                                            @endif
                                            </td>
                                            <td> {{ $discount->created_at }}</td>
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

        
        function confirmation(url) {
            var d = confirm("Are you sure you want to perform this action?");

            if (d) {
                window.location = url;
            }
        }
    </script>
@endsection