@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')


    <div class="content-wrapper">
        <div class="container-fluid">

        <div class="row">
                <div class="col-xl-3 col-sm-6">
                    
                    @if($user->country != null || !empty($user->country))
                        @if($user->country == "NG")
                        <div class="card mb-4 bg-purple" title="Pending bookings">
                            <div class="card-body">
                                <div class="media d-flex align-items-center ">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                        <i class="vl_book"></i>
                                    </div>
                                    <div class="media-body text-light" title="Pending bookings">
                                        <h4 class="text-uppercase mb-0 weight500">N{{$earned}}</h4>
                                        <span>Total Amount</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="card mb-4 bg-purple" title="Pending bookings">
                            <div class="card-body">
                                <div class="media d-flex align-items-center ">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                        <i class="vl_book"></i>
                                    </div>
                                    <div class="media-body text-light" title="Pending bookings">
                                        <h4 class="text-uppercase mb-0 weight500">N{{$earnedPounds}}</h4>
                                        <span>Total Amount</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif
                    @if(auth()->user()->type == 1)
                        @if($ven != null)
                            <div class="card mb-4 bg-purple" title="Pending bookings">
                                <div class="card-body">
                                    <div class="media d-flex align-items-center ">
                                        <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                            <i class="vl_money"></i>
                                        </div>
                                        <div class="media-body text-light" title="Pending bookings">
                                            <h4 class="text-uppercase mb-0 weight500">
                                                £ {{ number_format($vendorsTotalCost) }}</h4>
                                            <span>{{$ven->vendor->name}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
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
                                 

                                   
                                    <div style="width: 100%">
                                        <input type="submit" class="btn btn-danger pull-right mt-2" style="margin-left: 15px;" value="Search">
                                       
                                            <input type="submit" class="btn btn-warning pull-left mt-2"  name="export"
                                                   style="margin-left: 20px" value="Export">
                                        
                                    </div>
                                    @csrf
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

           

            <div class="row">
                <div class="col-xl-12 container">
                    <ul class="nav nav-tabs nav-justified ">
                    @if(auth()->user()->type == 1)
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">Booking Transaction(Naira)</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Paid Commission(Naira)</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#poundB">Booking Transaction(Pounds)</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#poundP">Paid Commission(Pounds)</a>
                        </li> -->
                    @elseif(auth()->user()->type == 2)
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">Booking Transaction(Naira)</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Paid Commission(Naira)</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#poundB">Booking Transaction(Pounds)</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#poundP">Paid Commission(Pounds)</a>
                        </li> -->
                    @endif
                    </ul>
                </div>
                
                <br>
                <!-- Tab panes -->
                <div class="tab-content col-xl-12 p-0">
                    <div class="tab-pane active" id="home">
                       <div class="col-xl-12">
                            <div class="card card-shadow mb-4 ">
                                <div class="card-header border-0">
                                    <div class="custom-title-wrap border-0 position-relative pb-2">
                                        <div class="custom-title">Booking Transaction(Naira)</div>
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
                                                <th scope="col">Commission</th>
                                                <th>Booking Amount</th>
                                                @if(auth()->user()->type == 1)
                                                <th>User Role</th>
                                                @endif
                                                <th scope="col">Date</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                       
                                            @foreach($booking_trans as $booking_tran)
                                            
                                                    <tr>
                                                       
                                                        @if(auth()->user()->type == 1)
                                                            @if(!empty($booking_tran->user))
                                                            <td>{{ $booking_tran->user->first_name }} {{ $booking_tran->user->last_name }}</td>
                                                            @else
                                                            <td> <span class ="badge badge-danger"> Agent NULL</span></td>
                                                            @endif
                                                        @elseif(auth()->user()->type == 2)
                                                            @if(!empty($booking_tran->user))
                                                                <td>{{ $booking_tran->user->first_name }} {{ $booking_tran->user->last_name }}</td>
                                                            @else
                                                                <td> <span class ="badge badge-danger"> Agent NULL</span></td>
                                                            @endif
                                                        @endif
                                                        <td>₦{{ number_format($booking_tran->amount,2) }}</td>
                                                        <td>₦{{ number_format($booking_tran->cost_config,2) }}</td>
                                                        @if(auth()->user()->type == 1)
                                                            <td>
                                                                @if($booking_tran->user != null)
                                                                    @if($booking_tran->user->main_agent_id == null)
                                                                        Super agent
                                                                    @else
                                                                        Sub agent
                                                                    @endif
                                                                @endif
                                                            </td>
                                                       @endif
                                                        <td>{{ $booking_tran->created_at }}</td>
                                                    </tr>
                                                  
                                               
                                            @endforeach
                                        
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                      </div>
                    </div>
                   
                    <div class="tab-pane" id="poundB">
                       <div class="col-xl-12">
                            <div class="card card-shadow mb-4 ">
                                <div class="card-header border-0">
                                    <div class="custom-title-wrap border-0 position-relative pb-2">
                                        <div class="custom-title">Booking Transaction(£)</div>
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
                                                <th scope="col">Commission</th>
                                                <th>Booking Amount</th>
                                                @if(auth()->user()->type == 1)
                                                <th>User Role</th>
                                                @endif
                                                <th scope="col">Date</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($booking_trans_p as $booking_tran_p)
                                            
                                                    <tr>
                                                       
                                                        @if(auth()->user()->type == 1)
                                                        <td>{{ $booking_tran_p->user->first_name }} {{ $booking_tran_p->user->last_name }}</td>
                                                        @elseif(auth()->user()->type == 2)
                                                        <td>{{ $booking_tran_p->user->first_name }} {{ $booking_tran_p->user->last_name }}</td>
                                                        @endif
                                                        <td> £{{ number_format($booking_tran_p->amount,2) }}</td>
                                                        <td> £{{ number_format($booking_tran_p->cost_config,2) }}</td>
                                                        @if(auth()->user()->type == 1)
                                                            <td>
                                                                @if($booking_tran->user != null)
                                                                    @if($booking_tran->user->main_agent_id == null)
                                                                        Super agent
                                                                    @else
                                                                        Sub agent
                                                                    @endif
                                                                @endif
                                                            </td>
                                                       @endif
                                                       
                                                        <td>{{ $booking_tran_p->created_at }}</td>
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
        <!--footer-->
    @include('includes.footer')
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
        $(document).ready(function () {
            $('#data_table1').DataTable({
                "order": []
            });
        });
        function makeAdmin(id) {
            
            var d = confirm("Are you sure, you want to make this user an Admin?");

            if (d) {
                
                window.location = "/admin/make/"+id;
            }
        }

        function makeAgent(id) {
            var d = confirm("Are you sure, you want to make this user an Agent?");

            if (d) {
                window.location = "/agent/make/".id;
            }
        }

        function confirmation(url){
            var d = confirm("Are you sure, you want to perform this action?");

            if (d) {
                window.location = url;
            }
        }

        function imitate(id){
            var d = confirm("Are you sure, you want to imitate account?");

            if (d) {
                window.location = "/imitate/account/" + id;
            }

        }
    </script>
@endsection