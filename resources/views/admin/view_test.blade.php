@extends('layouts.admin')
@section('style')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Validate test</li>
                    </ol>
                </div>
                <h4 class="page-title">PCR Registered Tests</h4>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="container-fluid">

            <!--states start-->
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card mb-4 bg-purple" title="Pending bookings">
                        <div class="card-body">
                            <div class="media d-flex align-items-center ">
                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                    <i class="vl_book"></i>
                                </div>
                                <div class="media-body text-light" title="Pending bookings">
                                    <h4 class="text-uppercase mb-0 weight500">{{ $tests->count() }}</h4>
                                    <span class="text-black">Number of registered Test</span>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
              
            </div>

            <!--employee data table-->
            <div class="row">
                <div class="col-xl-12 p-0">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title">PCR Registered Tests</div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @include('errors.showerrors')
                            <div class="table-responsive" style="min-height: 500px; padding:2%">
                                @if($tests->count() > 0)
                                    <table class="table table-hover table-custom" id="data_table">
                                        <thead>
                                        <tr>
                                           
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Date Of Sampling</th>
                                            <th scope="col">Barcode</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                       


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tests as $test)
                                            <tr>
                                                @if(auth()->user()->type == "1")
                                                   
                                                    <div class="modal fade" id="bookingModal{{ $test->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Verify Payment</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <a href="{{ url('/booking/stripe/success?b='.encrypt_decrypt("encrypt",$test->id)) }}" target="_blank" class="btn btn-danger">Stripe</a>
                                                                    <a href="{{ url('/payment/confirmation?tx_ref='.$test->transaction_ref) }}" target="_blank" class="btn btn-danger">Flutterwave</a>
                                                                    <a href="{{ url('/payment/paystack/confirmation?trxref='.$test->transaction_ref) }}" target="_blank" class="btn btn-danger">Paystack</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    </td>
                                                @endif
                                                    @if(auth()->user()->vendor_id != "0")
                                                        <td><a href="{{ url('/view/booking/'.$test->id) }}"
                                                               class="btn btn-info">View</a>
                                                            <a href="{{ url('/send/booking/'.$test->id) }}"
                                                               class="btn btn-info">Send to Logistics Company</a>
                                                        </td>
                                                    @endif
                                                <td>
                                                    {{ $test->first_name }} {{ $test->last_name }}
                                                </td>
                                                <td>{{ $test->phone }}</td>
                                                <td>{{ $test->email }}</td>

                                                <td> {{ $test->created_at }} </td>
                                                
                                                <td>
                                                    {{$test->barcode}}
                                                </td>
                                               <td>
                                                   
                                                    @if($test->status == 1)
                                                        <span class="badge btn-warning">Inconceivable</span>
                                                    @elseif($test->status == 2)
                                                        <span class="badge btn-success">Postivie</span>
                                                    @elseif($test->status == 3)
                                                        <span class="badge btn-danger">Negative</span>
                                                    @elseif($test->status == 0)
                                                        <span class="badge btn-dark">None</span>
                                                    @endif
                                               </td>
                                                <td>
                                                        <div class="btn-group" role="group">
                                                            <button id="btnGroupDrop1" type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                
                                                                    <a href="javascript:;"
                                                                       onclick="setPositive('{{ $test->id }}')"
                                                                       class="dropdown-item">Positive</a>
                                                                    <a href="javascript:;"
                                                                       onclick="setNegative('{{ $test->id }}')"
                                                                       class="dropdown-item">Negative</a>
                                                                    <a href="javascript:;"
                                                                       onclick="Inconclusive('{{ $test->id }}')"
                                                                       class="dropdown-item">Inconclusive</a>
                                                          
                                                               
                                                            </div>
                                                        </div>
                                                    </td>


                                            </tr>
                                           

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
        <!--footer-->
    @include('includes.footer ')
    <!--/footer-->
    </div>


@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#data_table').DataTable({
                "order": []
            });
        });

        function setPositive(id) {
            var d = confirm("Are you sure you want to confirm the result is: POSITIVE?");
            if (d) {
                window.location = "/test/status/" + id+ "/2";
            }
        }

        function setNegative(id) {
            var d = confirm("Are you sure you want to confirm the result is: NEGATIVE?");
            if (d) {
                window.location = "/test/status/" + id + "/3";
            }
        }

        function Inconclusive(id) {
            var d = confirm("Are you sure you want to confirm the result is: INCONCLUSIVE?");
            if (d) {
                window.location = "/test/status/" + id + "/1";
            }
        }
    </script>
@endsection
