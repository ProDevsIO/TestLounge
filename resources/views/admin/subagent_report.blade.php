@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')


    <div class="content-wrapper">
        <div class="container-fluid">
               
                        <h4>Subagent Financial Report</h4>
             
                <br>
            <!--states start-->
            <div class="row">
                <div class="col-xl-4"></div>
                <div class="col-xl-8 col-sm-8 col-lg-8 p-0">
                    <div class="card mb-4 bg-primary" title="Completed bookings">
                        <div class="card-body">
                            <h3>Filter</h3>

                            <form class="form-inline">
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
                                        <input type="submit" class="btn btn-danger pull-right mt-2" value="Search">
                                    
                                   
                                            <input type="submit" class="btn btn-warning pull-left mt-2" name="export"
                                                   style="margin-left: 20px" value="Export">
                                        
                                    @csrf
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-3">
                   
                        <div class="card mb-4 bg-purple" title="Total commission gained by subagents">
                            <div class="card-body">
                                <div class="media d-flex align-items-center ">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                        <i class="vl_book"></i>
                                    </div>
                                    <div class="media-body text-light">
                                        <h4 class="text-uppercase mb-0 weight500">???{{ number_format($pcommission) }}</h4>
                                        <span>Total Revenue(Naira)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                </div>
                <div class="col-xl-3 col-sm-3">
                  
                        <div class="card mb-4 bg-purple" title="Total commission gained by subagents">
                            <div class="card-body">
                                <div class="media d-flex align-items-center ">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                        <i class="vl_book"></i>
                                    </div>
                                    <div class="media-body text-light">
                                        <h4 class="text-uppercase mb-0 weight500">${{ number_format($commission) }}</h4>
                                        <span>Total Revenue(Dollars)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
               
                <div class="col-xl-3 col-sm-3">
                    <div class="card mb-4 bg-purple" title="Total amount to be paid to subagents">
                        <div class="card-body">
                            <div class="media d-flex align-items-center ">
                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                    <i class="vl_book"></i>
                                </div>
                                <div class="media-body text-light">
                                    <h4 class="text-uppercase mb-0 weight500">${{ number_format($duePounds) }}</h4>
                                    <span>Amount due(Referrals)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               

                <div class="col-xl-3 col-sm-3">
                    <div class="card mb-4 bg-purple" title="Total amount to be paid to subagents">
                        <div class="card-body">
                            <div class="media d-flex align-items-center ">
                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                    <i class="vl_book"></i>
                                </div>
                                <div class="media-body text-light">
                                    <h4 class="text-uppercase mb-0 weight500">???{{ number_format($dueNaira) }}</h4>
                                    <span>Amount due(Referrals)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--employee data table-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title">Sub Agents</div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @include('errors.showerrors')
                            <div class="table-responsive">
                                <table class="table table-hover table-custom" id="data_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Referral Code</th>
                                        <th scope="col">Total C.Bookings</th>
                                        <th scope="col">Naira Wallet Balance</th>
                                        <th scope="col">Dollars Wallet Balance</th>
                                        <th scope="col">Account Details</th>
                                        <th scope="col">Option</th>
                                        <!-- <th scope="col">Action</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            </td>
                                            <td>
                                                <a href="{{ url(env("APP_URL")."booking?ref=".$user->referal_code) }}"
                                                   target="_blank">{{ $user->referal_code }}</a><br/>
                                                {{ $user->phone_no }}<br/>
                                                {{ $user->email }}
                                            </td>
                                            <td>{{ $user->cbookings->count() }}</td>
                                            <td>N{{ number_format($user->wallet_balance,2) }}</td>
                                            <td>${{ number_format($user->pounds_wallet_balance,2) }}</td>
                                            <td>
                                                <ul>
                                                    <li>Country: {{ $user->country }}</li>
                                                    <li>Bank: {{ $user->bank }}</li>
                                                    <li>Account No: {{ $user->account_no }}</li>
                                                    <li>Account Name: {{ $user->account_name }}</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button"
                                                            class="btn btn-secondary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                      <a class="dropdown-item" href="{{ url('/view/agent/details/'.$user->id) }}">View </a>
                                                      <a class="dropdown-item" href="{{ url('/view/sub-agent/transaction/'.$user->id) }}">View transaction</a>
                                                    </div>
                                                </div>


                                            </td>
                                        </tr>

                                        <div class="modal fade" id="makePayment{{ $user->id }}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ url('make/pay') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Make Payment</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label>Amount: </label>
                                                            <input type="number" name="amount" class="form-control"/>
                                                            <br>
                                                            <label>Currency: </label>
                                                            <select name="type" class="form-control" id="" required>
                                                                <option value="">Please Select a Currency</option>
                                                                <option value="1">Naira</option>
                                                                <option value="2">Dollars</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Make Payment
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

        function resendReceipt(id) {
            var d = confirm("Are you sure you want to resend the receipt?");
            if (d) {
                window.location = "/resend/receipt/" + id;
            }
        }
    </script>
@endsection