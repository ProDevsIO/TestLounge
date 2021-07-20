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
                                        <th scope="col">Vendor</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Percentage</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{ $user->first_name }} {{ $user->first_name }}
                                            </td>
                                            <td>{{ $user->phone_no }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->pbookings->count() }}</td>
                                            <td>{{ $user->cbookings->count() }}</td>
                                            <td>{{ ($user->vendor) ? $user->vendor->name : "Not a Vendor" }}</td>
                                            @if($user->status == 1)
                                                 <td> <span class="badge badge-success">Active</span></td>
                                            @elseif($user->status == 0)
                                                 <td> <span class="badge badge-warning">Not Active</span></td>
                                            @endif
                                            @if($user->percentage_split == null)
                                            <td>None</td>
                                            @else
                                            <td>{{$user->percentage_split}}%</td>
                                            @endif
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <a class="dropdown-item" href="{{ url('complete/booking?user_id='.$user->id) }}">View Bookings</a>
                                                        @if($user->type == 0)
                                                            <a href="{{ url('complete/booking?vendor_id='.$user->id) }}"
                                                               class="dropdown-item">Make Admin</a>
                                                        @else
                                                            @if(auth()->user()->id != $user->id)
                                                            <a href="javascript:;" onclick="makeAdmin('{{ $user->id }}')"
                                                               class="dropdown-item">Make Agent</a>
                                                                @endif
                                                        @endif
                                                        
                                                        @if($user->type == 2)
                                                             <a href="{{ url('/agent/percent/' .$user->id) }}" class="dropdown-item">Percentage</a>
                        
                                                            @if($user->status == 0)
                                                            
                                                                <a href="{{ url('/agent/activate/' .$user->id) }}" class="dropdown-item">Activate</a>
                        

                                                            @elseif($user->status == 1)
                                                           
                                                                <a href="{{ url('/agent/deactivate/'.$user->id) }}" class="dropdown-item">Deactivate</a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>



                                            </td>
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

        function makeAdmin(id){
            var d = confirm("Are you sure, you want to make this user an Admin?");

            if(d){
                window.location = "/admin/make/".id;
            }
        }
        function makeAgent(id){
            var d = confirm("Are you sure, you want to make this user an Agent?");

            if(d){
                window.location = "/agent/make/".id;
            }
        }
    </script>
@endsection