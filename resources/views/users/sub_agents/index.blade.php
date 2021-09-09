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
                                    <span>Sub-Agents</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--employee data table-->
            <div class="row">
                @if (!auth()->user()->isAdmin())
                <div class="col-12 text-right mb-3">
                    <a href="{{ route("sub-agents.create")}}" class="btn btn-primary">
                        New Sub-Agent
                    </a>
                </div>
                @endif

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
                @if (!auth()->user()->isAdmin())
                <div class="tab-content col-xl-12 p-0">
                    <div class="tab-pane active" id="home">
                        @include("users.sub_agents.fragments.table" , ["id" => "data_table" , "table_status" => 1])
                    </div>
                    <div class="tab-pane fade" id="menu1">

                        @include("users.sub_agents.fragments.table" , ["id" => "data_table1" ,
                        "table_status" => 0])

                    </div>
                </div>
                @else
                <div class="tab-content col-xl-12 p-0">
                    <div class="tab-pane active" id="home">
                        @include("users.sub_agents.fragments.admin_table" , ["id" => "data_table" , "table_status" => 1])
                    </div>
                    <div class="tab-pane fade" id="menu1">

                        @include("users.sub_agents.fragments.admin_table" , ["id" => "data_table1" ,
                        "table_status" => 0])

                    </div>
                </div>
                @endif
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
        $(document).ready(function() {
            $('#data_table').DataTable({
                "order": []
            });
        });
        $(document).ready(function() {
            $('#data_table1').DataTable({
                "order": []
            });
        });
        function confirmation(url) {
            var d = confirm("Are you sure, you want to perform this action?");

            if (d) {
                window.location = url;
            }
        }
    </script>
@endsection
