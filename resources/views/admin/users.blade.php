@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')


    <div class="content-wrapper">
        <div class="container-fluid">

            <!--states start-->
            <div class="row">
                <div class="col-xl-3 col-sm-6 p-0">
                    <div class="card mb-4 bg-purple" title="Pending bookings">
                        <div class="card-body">
                            <div class="media d-flex align-items-center ">
                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                    <i class="vl_book"></i>
                                </div>
                                <div class="media-body text-light" title="Pending bookings">
                                    <h4 class="text-uppercase mb-0 weight500">{{ $users->count() }}</h4>
                                    <span>Users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 p-0">
                    <div class="card mb-4 bg-info" title="Pending bookings">
                        <div class="card-body">
                            <div class="media d-flex align-items-center ">
                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                    <i class="vl_book"></i>
                                </div>
                                <div class="media-body text-light" title="Pending bookings">
                                    <h4 class="text-uppercase mb-0 weight500">{{ $active }}</h4>
                                    <span>Active Users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 p-0">
                    <div class="card mb-4 bg-danger" title="Pending bookings">
                        <div class="card-body">
                            <div class="media d-flex align-items-center ">
                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                    <i class="vl_book"></i>
                                </div>
                                <div class="media-body text-light" title="Pending bookings">
                                    <h4 class="text-uppercase mb-0 weight500">{{ $not_active }}</h4>
                                    <span>Not Active Users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <!--employee data table-->
            <div class="row">
                <div class="col-xl-12 container">
                    <ul class="nav nav-tabs nav-justified ">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Not Active</a>
                        </li>
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
                                        <div class="custom-title pull-left">Users</div>
                                        <div class="pull-right"><a href="{{ url('/active/agent/export') }}"
                                                                   class="btn btn-md btn-warning text-white">Export</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    @include('errors.showerrors')
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom" id="data_table">
                                            <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Pending Booking</th>
                                                <th scope="col">Completed Bookings</th>
                                                <th scope="col">User Type</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Percentage</th>
                                                <th scope="col">Referral Code</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                @if($user->status == 1)
                                                    <tr>
                                                        <td>
                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                        </td>
                                                        <td>{{ $user->phone_no }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->pbookings->count() }}</td>
                                                        <td>{{ $user->cbookings->count() }}</td>
                                                        <td>@if($user->type == 1)
                                                                Admin
                                                            @elseif($user->type == 2)
                                                                @if($user->main_agent_id)
                                                                    Sub Agent
                                                                @else
                                                                    Super Agent
                                                                @endif
                                                            @else
                                                                Vendor
                                                            @endif

                                                        </td>


                                                        @if($user->status == 1)
                                                            <td><span class="badge badge-success">Active</span></td>
                                                        @elseif($user->status == 0)
                                                            <td><span class="badge badge-warning">Not Active</span></td>
                                                        @endif
                                                        @if($user->percentage_split == null)
                                                            <td>Total: {{$setting->value}}%
                                                                @if($user->main_agent_id)
                                                                    <br/>
                                                                   (Super Agent: {{ $user->main_agent_share_raw }}%)<br/>
                                                                    (Sub Agent:: {{ 100 - $user->main_agent_share_raw }}%)<br/>
                                                                @endif
                                                            </td>
                                                        @else
                                                            <td>Total: {{$user->percentage_split}}%
                                                                @if($user->main_agent_id)
                                                                    <br/>
                                                                    (Super Agent: {{ $user->main_agent_share_raw }}%)<br/>
                                                                    Sub Agent:: {{ 100 - $user->main_agent_share_raw }}%)<br/>
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <a href="{{ url(env("APP_URL")."booking?ref=".$user->referal_code) }}"
                                                               target="_blank">{{ $user->referal_code }}</a>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button id="btnGroupDrop1" type="button"
                                                                        class="btn btn-secondary dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                     aria-labelledby="btnGroupDrop1">
                                                                    <!-- <a class="dropdown-item"
                                                                       href="{{ url('/view/agent/details/'.$user->id) }}">View
                                                                        </a>
                                                                    <a class="dropdown-item"
                                                                       href="{{ url('complete/booking?user_id='.$user->id) }}">View
                                                                        Bookings</a> -->

                                                                    <a class="dropdown-item"
                                                                       href="javascript:;"
                                                                       onclick="imitate('{{ $user->id }}')">Imitate
                                                                        Account</a>

                                                                    @if($user->type == 2)
                                                                        <a href="javascript:;"
                                                                           onclick="makeAdmin('{{ $user->id }}')"
                                                                           class="dropdown-item">Make Admin</a>

                                                                        <!-- deleting an agent -->
                                                                        @if(auth()->user()->type == 1)
                                                                            <a href="javascript:;"
                                                                               onclick="confirmation('{{ url('/users/delete/' .$user->id) }}')"
                                                                               class="dropdown-item">Delete</a>
                                                                        @endif
                                                                    @endif

                                                                    <!-- @if($user->type == 2)
                                                                        <a href="{{ url('/agent/percent/' .$user->id) }}"
                                                                           class="dropdown-item">Change Percentage</a>
                                                                        <a href="javascript:;" data-toggle="modal"
                                                                           data-target="#changeReferral{{ $user->id }}"
                                                                           class="dropdown-item">Change Referral
                                                                            Code</a>
                                                                            @if($user->main_agent_id == null)
                                                                                <a href="javascript:;" data-toggle="modal"
                                                                                data-target="#assign{{ $user->id }}"
                                                                                class="dropdown-item">Assign a sub agent</a>
                                                                            @endif
                                                                        @if($user->copy_receipt == 0)

                                                                            <a href="javascript:;"
                                                                               onclick="confirmation('{{ url('/agent/copy/' .$user->id) }}')"
                                                                               class="dropdown-item">Enable copy in
                                                                                receipt</a>

                                                                        @elseif($user->copy_receipt == 1)

                                                                            <a href="javascript:;"
                                                                               onclick="confirmation('{{ url('/agent/copy/' .$user->id) }}')"
                                                                               class="dropdown-item">Disable copy in
                                                                                receipt</a>

                                                                        @endif

                                                                        @if($user->enable_barcode == 0)

                                                                            <a href="javascript:;"
                                                                            onclick="confirmation('{{ url('/barcode/process/' .$user->id. '/0') }}')"
                                                                            class="dropdown-item">Enable barcode scanner</a>

                                                                        @elseif($user->enable_barcode == 1)

                                                                            <a href="javascript:;"
                                                                            onclick="confirmation('{{ url('/barcode/process/' .$user->id.'/1') }}')"
                                                                            class="dropdown-item">Disable barcode scanner</a>

                                                                        @endif

                                                                        @if($user->status == 0)

                                                                            <a href="javascript:;"
                                                                               onclick="confirmation('{{ url('/agent/activate/' .$user->id) }}')"
                                                                               class="dropdown-item">Activate</a>


                                                                        @elseif($user->status == 1)

                                                                            <a href="javascript:;"
                                                                               onclick="confirmation('{{ url('/agent/deactivate/'.$user->id) }}')"
                                                                               class="dropdown-item">Deactivate</a>
                                                                        @endif

                                                                        @if($user->status == 1)
                                                                        <a href="javascript:;" data-toggle="modal"
                                                                                data-target="#assignVoucher{{ $user->id }}"
                                                                                class="dropdown-item">Assign vouchers</a>
                                                                           
                                                                        @endif -->
                                                                    <!-- @endif -->
                                                                </div>
                                                            </div>


                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="changeReferral{{ $user->id }}"
                                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{ url('/change/referral_code/'.$user->id) }}"
                                                                      method="post">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Change Referral Code</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <label>Referral Code</label>
                                                                        <input type="text" name="referal_code"
                                                                               class="form-control"
                                                                               value="{{ $user->referal_code }}">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close
                                                                        </button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Save changes
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="assign{{ $user->id }}"
                                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{ url('/assign/sub-agent/'.$user->id) }}"
                                                                      method="post">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Assign a sub agent</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <label class="text-muted">Agents</label>
                                                                        <select name="agent" class="form-control" id="">
                                                                            @foreach($users as $agent)
                                                                             <option value="{{$agent->id}}"> {{$agent->first_name}} {{$agent->last_name}}</option>
                                                                            @endforeach
                                                                        </select>

                                                                        <label class="text-muted">Your Percentage Share</label>
                                                                        <input type="number" class="form-control" step="0.25" value="{{ $user->main_agent_share_raw }}" name="my_share">
                                                                        
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close
                                                                        </button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Save changes
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
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
                                        <div class="custom-title pull-left">Users</div>
                                        <div class="pull-right"><a href="{{ url('/inactive/agent/export') }}"
                                                                   class="btn btn-md btn-warning text-white">Export</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    @include('errors.showerrors')
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom" id="data_table1">
                                            <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Pending Booking</th>
                                                <th scope="col">Completed Bookings</th>
                                                <th scope="col">User Type</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Percentage</th>
                                                <th scope="col">Referral Code</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                @if($user->status == 0)
                                                    <tr>
                                                        <td>
                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                        </td>
                                                        <td>{{ $user->phone_no }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->pbookings->count() }}</td>
                                                        <td>{{ $user->cbookings->count() }}</td>
                                                        <td>@if($user->type == 1)
                                                                Admin
                                                            @elseif($user->type == 2)
                                                                @if($user->main_agent_id)
                                                                    Sub Agent ({{ $user->superAgent->first_name." ".$user->superAgent->last_name }})
                                                                @else
                                                                    Super Agent
                                                                @endif
                                                            @else
                                                                Vendor
                                                            @endif

                                                        </td>


                                                        @if($user->status == 1)
                                                            <td><span class="badge badge-success">Active</span></td>
                                                        @elseif($user->status == 0)
                                                            <td><span class="badge badge-warning">Not Active</span></td>
                                                        @endif
                                                        @if($user->percentage_split == null)
                                                            <td>Total: {{$setting->value}}%

                                                                @if($user->main_agent_id)
                                                                    <br/>
                                                                    (Super Agent: {{ $user->main_agent_share_raw }}%)<br/>
                                                                    (Subagent: {{ 100 - $user->main_agent_share_raw }}%)<br/>
                                                                @endif
                                                            </td>
                                                        @else
                                                            <td>Total: {{$user->percentage_split}}%
                                                                @if($user->main_agent_id)
                                                                    <br/>
                                                                    (Super Agent: {{ $user->main_agent_share_raw }}%)<br/>
                                                                    (Sub Agent:: {{ 100 - $user->main_agent_share_raw }}%)<br/>
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <a href="{{ url(env("APP_URL")."booking?ref=".$user->referal_code) }}"
                                                               target="_blank">{{ $user->referal_code }}</a>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button id="btnGroupDrop1" type="button"
                                                                        class="btn btn-secondary dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                     aria-labelledby="btnGroupDrop1">
                                                                    <!-- <a class="dropdown-item"
                                                                       href="{{ url('complete/booking?user_id='.$user->id) }}">View
                                                                        Bookings</a> -->


                                                                    @if($user->type == 2)
                                                                        <a href="javascript:;"
                                                                           onclick="makeAdmin('{{ $user->id }}')"
                                                                           class="dropdown-item">Make Admin</a>

                                                                        <!-- deleting an agent -->
                                                                        @if(auth()->user()->type == 1)
                                                                            <a href="javascript:;"
                                                                               onclick="confirmation('{{ url('/users/delete/' .$user->id) }}')"
                                                                               class="dropdown-item">Delete</a>
                                                                        @endif
                                                                    @endif

                                                                    @if($user->type == 2)
                                                                        <!-- <a href="{{ url('/agent/percent/' .$user->id) }}"
                                                                           class="dropdown-item">Change Percentage</a>
                                                                        <a href="javascript:;" data-toggle="modal"
                                                                           data-target="#changeReferral{{ $user->id }}"
                                                                           class="dropdown-item">Change Referral
                                                                            Code</a> -->

                                                                        @if($user->status == 0)

                                                                            <a href="javascript:;"
                                                                               onclick="confirmation('{{ url('/agent/activate/' .$user->id) }}')"
                                                                               class="dropdown-item">Activate</a>


                                                                        @elseif($user->status == 1)

                                                                            <a href="javascript:;"
                                                                               onclick="confirmation('{{ url('/agent/deactivate/'.$user->id) }}')"
                                                                               class="dropdown-item">Deactivate</a>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>


                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="changeReferral{{ $user->id }}"
                                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{ url('/change/referral_code/'.$user->id) }}"
                                                                      method="post">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Change Referral Code</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <label>Referral Code</label>
                                                                        <input type="text" name="referal_code"
                                                                               class="form-control"
                                                                               value="{{ $user->referal_code }}">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close
                                                                        </button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Save changes
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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

        </div>

                                                @foreach($users as $user)
                                                    <div class="modal fade" id="assignVoucher{{ $user->id }}"
                                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{ url('/assign/voucher/'.$user->id) }}"
                                                                      method="post">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Assign Voucher</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <label class="text-muted">Products</label>
                                                                        <select name="product_id" class="form-control" id="" required>
                                                                            @foreach($products as $product)
                                                                             <option value="{{$product->id}}"> {{$product->name}}</option>
                                                                            @endforeach
                                                                        </select>

                                                                        <label class="text-muted">Number to be assigned</label>
                                                                       <select name="number" class="form-control" id="" required>
                                                                           <option value="">Select a number to be assigned</option>
                                                                           @for($i=0; $i < 100; $i++)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                           @endfor
                                                                       </select>
                                                                        
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close
                                                                        </button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Assign
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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

            var d = confirm("Are you sure you want to make this user an Admin?");

            if (d) {

                window.location = "/admin/make/" + id;
            }
        }

        function makeAgent(id) {
            var d = confirm("Are you sure you want to make this user an Agent?");

            if (d) {
                window.location = "/agent/make/".id;
            }
        }

        function confirmation(url) {
            var d = confirm("Are you sure you want to perform this action?");

            if (d) {
                window.location = url;
            }
        }

        function imitate(id) {
            var d = confirm("Are you sure you want to imitate account?");

            if (d) {
                window.location = "/imitate/account/" + id;
            }

        }
    </script>
@endsection