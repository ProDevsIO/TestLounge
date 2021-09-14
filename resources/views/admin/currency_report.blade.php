@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">


            <!--employee data table-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title pull-left">
                                           @if($currency == 'naira')
                                           Total Revenue(Naira)
                                            @elseif($currency == 'pounds')
                                            Total Revenue(Pounds)
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
                                <div class="pull-right"> <a href="{{ url('/currency/export/'.$currency.'/'.$startDate .'/'. $endDate) }}" class="btn btn-md btn-warning text-white">Export</a></div>
                                  
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @include('errors.showerrors')
                            <div class="table-responsive">
                                <table class="table table-hover table-custom" id="data_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Qunatity</th>
                                        <th scope="col">vendor</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transact as $transact)
                                        <tr>
                                            <td>
                                                {{ $transact->booking->first_name }}   {{ $transact->booking->last_name }}
                                            </td>
                                            <td>
                                                {{$transact->product->name}}
                                            </td>
                                            <td>
                                                {{$transact->quantity}}
                                            </td>
                                            <td> {{$transact->vendor->name}}</td>
                                            @if($transact->currency == 'NGN')
                                            <td>N{{ number_format($transact->charged_amount,2) }}</td>
                                            @elseif($transact->currency == 'GBP')
                                            <td>£{{ number_format($transact->charged_amount,2) }}</td>
                                            @elseif($transact->currency = 'GHS')
                                            <td>GHS{{ number_format($transact->charged_amount,2) }}</td>
                                            @elseif($transact->currency = 'TZS')
                                            <td>TZS{{ number_format($transact->charged_amount,2) }}</td>
                                            @elseif($transact->currency = 'KES')
                                            <td>KES{{ number_format($transact->charged_amount,2) }}</td>
                                            @elseif($transact->currency = 'ZAR')
                                            <td>ZAR{{ number_format($transact->charged_amount,2) }}</td>
                                            @endif
                                            <td>{{$transact->created_at}}</td>
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