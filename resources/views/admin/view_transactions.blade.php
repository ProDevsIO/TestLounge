@extends('layouts.admin')
@section('style')
<style>

.modal-backdrop.show
{
    opacity:1 !important;
    background-color:#353935 !important;

    filter: blur(20px);
  -webkit-filter: blur(8px);
}
</style>
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    
        <!----force modal if country not filled in db -->
        <div id="countryForce" class="modal"  style="">
            <div class="modal-dialog modal-dialog-centered" style="padding-right:none">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Access code required</h5>
                    </div>
                    <div class="modal-body">
                    @include('errors.showerrors')
                        <form action="{{ url('view/transactions') }}" method="post">
                            @csrf
                           <input type="password" name="code" placeholder="please input your secret code"class="form-control" required>
                            <br>
                            <button type="submit" class="btn btn-primary">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end of country force modal-->
    <div class="content-wrapper">
        <div class="container-fluid">

            <!--states start-->
            <!-- <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card mb-4 bg-purple" title="Pending bookings">
                        <div class="card-body">
                            <div class="media d-flex align-items-center ">
                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                    <i class="vl_book"></i>
                                </div>
                                <div class="media-body text-light" title="Pending bookings">
                                    <h4 class="text-uppercase mb-0 weight500"></h4>
                                    <span>Users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!--employee data table-->
            <div class="">
                @if(auth()->user()->type == 1)
                <h4>All Agent Commissions</h4>
                @else
                <h4>Agent Commissions</h4>
                @endif
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                <div class="card mb-4 bg-success">
                            <div class="card-body" title="Total money earned from bookings naira">
                                <div class="media d-flex align-items-center">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-success">
                                        <i class="vl_money"></i>
                                    </div>
                                    <div class="media-body text-white" title="Total money earned from bookings">
                                        <h4 class="text-uppercase mb-0 weight500">
                                            N{{ number_format($gained,3) }}</h4>
                                        <span> Total Credit transactions(Naira)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-6">
                <div class="card mb-4 bg-success">
                            <div class="card-body" title="Total money earned from bookings">
                                <div class="media d-flex align-items-center">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-success">
                                        <i class="vl_money"></i>
                                    </div>
                                    <div class="media-body text-white">
                                        <h4 class="text-uppercase mb-0 weight500">
                                        ${{ number_format($gainedPounds,3) }}</h4>
                                        <span>Total Credit transactions(Dollars)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-6">
                <div class="card mb-4 bg-purple">
                            <div class="card-body" title="Total money paid from wallet Balance(N)">
                                <div class="media d-flex align-items-center">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-success">
                                        <i class="vl_money"></i>
                                    </div>
                                    <div class="media-body text-white">
                                        <h4 class="text-uppercase mb-0 weight500">
                                            N{{ number_format($earned,3) }}</h4>
                                        <span>Expected Earnings(Naira)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-6">
                <div class="card mb-4 bg-purple">
                            <div class="card-body" title="Total money paid from wallet balance($)">
                                <div class="media d-flex align-items-center">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-success">
                                        <i class="vl_money"></i>
                                    </div>
                                    <div class="media-body text-white">
                                        <h4 class="text-uppercase mb-0 weight500">
                                        ${{ number_format($earnedPounds,3) }}</h4>
                                        <span>Expected Earnings(Dollars)</span>
                                    </div>
                                </div>
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
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Paid Commission(Naira)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#poundB">Booking Transaction(Dollars)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#poundP">Paid Commission(Dollars)</a>
                        </li>
                    @elseif(auth()->user()->type == 2)
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">Booking Transaction(Naira)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Paid Commission(Naira)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#poundB">Booking Transaction(Dollars)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#poundP">Paid Commission(Dollars)</a>
                        </li>
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
                                                        <td>₦{{ number_format($booking_tran->amount,3) }}</td>
                                                        <td>₦{{ number_format($booking_tran->cost_config,3) }}</td>
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
                    <div class="tab-pane fade" id="menu1">
                      <div class="col-xl-12">
                            <div class="card card-shadow mb-4 ">
                                <div class="card-header border-0">
                                    <div class="custom-title-wrap border-0 position-relative pb-2">
                                        <div class="custom-title">Paid Commission(N)</div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    @include('errors.showerrors')
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom" id="data_table1">
                                            <thead>
                                            <tr>
                                                @if(auth()->user()->type == 1)
                                                <th> Agent</th>
                                                @elseif(auth()->user()->type == 2)
                                                <th scope="col">Name</th>
                                                @endif
                                                <th scope="col"> Commission</th>
                                                <th scope="col">Booking Amount</th>
                                                <th scope="col">Date</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($paid_trans as $paid_tran)
                                            
                                                <tr>
                                                   
                                                @if(!empty($paid_tran->user))
                                                    <td>{{ optional($paid_tran->user)->first_name }} {{ optional($paid_tran->user)->last_name }}</td>
                                                @else
                                                <td>Agent Null</td>
                                                @endif
                                                    <td>₦{{number_format($paid_tran->amount,3) }}</td>
                                                    <td>₦{{number_format($paid_tran->cost_config,3)}}</td>
                                                    <td>{{ $paid_tran->created_at }}</td>
                                                  
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
                                        <div class="custom-title">Booking Transaction($
)</div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    @include('errors.showerrors')
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom" id="data_table2">
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
                                                    @if(!empty($booking_tran_p->user))
                                                        <td>{{ $booking_tran_p->user->first_name }} {{ $booking_tran_p->user->last_name }}</td>
                                                    @else
                                                        <td>Agent null</td>
                                                    @endif
                                                        <td> ${{ number_format($booking_tran_p->amount,3) }}</td>
                                                        <td> ${{ number_format($booking_tran_p->cost_config,3) }}</td>
                                                        @if(auth()->user()->type == 1)
                                                            <td>
                                                                @if($booking_tran_p->user != null)
                                                                    @if($booking_tran_p->user->main_agent_id == null)
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
                    <div class="tab-pane fade" id="poundP">
                      <div class="col-xl-12">
                            <div class="card card-shadow mb-4 ">
                                <div class="card-header border-0">
                                    <div class="custom-title-wrap border-0 position-relative pb-2">
                                        <div class="custom-title">Paid Commision($
)</div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    @include('errors.showerrors')
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom" id="data_table1">
                                            <thead>
                                            <tr>
                                                @if(auth()->user()->type == 1)
                                                <th> Agent</th>
                                                @elseif(auth()->user()->type == 2)
                                                <th scope="col">Name</th>
                                                @endif
                                                <th scope="col"> Commission</th>
                                                <th scope="col">Booking Amount</th>
                                                <th scope="col">Date</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($paid_trans_p as $paid_tran_p)
                                                <tr>
                                                @if(!empty($paid_tran_p->user))
                                                    <td>{{ $paid_tran_p->user->first_name }} {{ $paid_tran_p->user->last_name }}</td>
                                                @else
                                                    <td>Agent null</td>
                                                @endif
                                                    <td>${{number_format($paid_tran_p->amount,3) }}</td>
                                                    <td>${{number_format($paid_tran_p->cost_config,3)}}</td>
                                                    <td>{{ $paid_tran_p->created_at }}</td>
                                                  
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
        $(document).ready(function () {
            $('#data_table2').DataTable({
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
      @if(auth()->user()->id == 55 && $code != 6780 )
        <script>
            $(document).ready(function () {
                $("#countryForce").modal({backdrop: 'static', keyboard: false}, 'show');
            });

        </script>
    @endif
@endsection