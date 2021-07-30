@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')


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
                                    <h4 class="text-uppercase mb-0 weight500">{{ $users->count() }}</h4>
                                    <span>Users</span>
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
                                        <div class="custom-title">Users</div>
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
                                                        {{ $user->first_name }} {{ $user->first_name }}
                                                    </td>
                                                    <td>{{ $user->phone_no }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->pbookings->count() }}</td>
                                                    <td>{{ $user->cbookings->count() }}</td>
                                                    <td>@if($user->type == 1)
                                                            Admin
                                                        @elseif($user->type == 2)
                                                            Agent
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
                                                        <td>{{$setting->value}}%</td>
                                                    @else
                                                        <td>{{$user->percentage_split}}%</td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ url(env("APP_URL")."booking?ref=".$user->referal_code) }}" target="_blank">{{ $user->referal_code }}</a>
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
                                                                <a class="dropdown-item"
                                                                href="{{ url('complete/booking?user_id='.$user->id) }}">View
                                                                    Bookings</a>

                                                                    
                                                                @if($user->type == 2)
                                                                    <a href="javascript:;" onclick="makeAdmin('{{ $user->id }}')"
                                                                    class="dropdown-item">Make Admin</a>

                                                                    <!-- deleting an agent -->  
                                                                    @if(auth()->user()->type == 1)
                                                                        <a href="javascript:;" onclick="confirmation('{{ url('/users/delete/' .$user->id) }}')"
                                                                        class="dropdown-item">Delete</a>
                                                                    @endif
                                                                @endif

                                                                @if($user->type == 2)
                                                                    <a href="{{ url('/agent/percent/' .$user->id) }}"
                                                                    class="dropdown-item">Change Percentage</a>
                                                                    <a href="javascript:;" data-toggle="modal" data-target="#changeReferral{{ $user->id }}"
                                                                    class="dropdown-item">Change Referral Code</a>

                                                                    @if($user->status == 0)

                                                                        <a href="javascript:;" onclick="confirmation('{{ url('/agent/activate/' .$user->id) }}')"
                                                                        class="dropdown-item">Activate</a>


                                                                    @elseif($user->status == 1)

                                                                        <a href="javascript:;" onclick="confirmation('{{ url('/agent/deactivate/'.$user->id) }}')"
                                                                        class="dropdown-item">Deactivate</a>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>


                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="changeReferral{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ url('/change/referral_code/'.$user->id) }}" method="post">
                                                        @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Change Referral Code</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label>Referral Code</label>
                                                                <input type="text" name="referal_code" class="form-control" value="{{ $user->referal_code }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
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
                                        <div class="custom-title">Users</div>
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
                                                        {{ $user->first_name }} {{ $user->first_name }}
                                                    </td>
                                                    <td>{{ $user->phone_no }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->pbookings->count() }}</td>
                                                    <td>{{ $user->cbookings->count() }}</td>
                                                    <td>@if($user->type == 1)
                                                            Admin
                                                        @elseif($user->type == 2)
                                                            Agent
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
                                                        <td>{{$setting->value}}%</td>
                                                    @else
                                                        <td>{{$user->percentage_split}}%</td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ url(env("APP_URL")."booking?ref=".$user->referal_code) }}" target="_blank">{{ $user->referal_code }}</a>
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
                                                                <a class="dropdown-item"
                                                                href="{{ url('complete/booking?user_id='.$user->id) }}">View
                                                                    Bookings</a>

                                                                    
                                                                @if($user->type == 2)
                                                                    <a href="javascript:;" onclick="makeAdmin('{{ $user->id }}')"
                                                                    class="dropdown-item">Make Admin</a>

                                                                    <!-- deleting an agent -->  
                                                                    @if(auth()->user()->type == 1)
                                                                        <a href="javascript:;" onclick="confirmation('{{ url('/users/delete/' .$user->id) }}')"
                                                                        class="dropdown-item">Delete</a>
                                                                    @endif
                                                                @endif

                                                                @if($user->type == 2)
                                                                    <a href="{{ url('/agent/percent/' .$user->id) }}"
                                                                    class="dropdown-item">Change Percentage</a>
                                                                    <a href="javascript:;" data-toggle="modal" data-target="#changeReferral{{ $user->id }}"
                                                                    class="dropdown-item">Change Referral Code</a>

                                                                    @if($user->status == 0)

                                                                        <a href="javascript:;" onclick="confirmation('{{ url('/agent/activate/' .$user->id) }}')"
                                                                        class="dropdown-item">Activate</a>


                                                                    @elseif($user->status == 1)

                                                                        <a href="javascript:;" onclick="confirmation('{{ url('/agent/deactivate/'.$user->id) }}')"
                                                                        class="dropdown-item">Deactivate</a>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>


                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="changeReferral{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ url('/change/referral_code/'.$user->id) }}" method="post">
                                                        @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Change Referral Code</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label>Referral Code</label>
                                                                <input type="text" name="referal_code" class="form-control" value="{{ $user->referal_code }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
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
                window.location = "/admin/make/".id;
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
    </script>
@endsection