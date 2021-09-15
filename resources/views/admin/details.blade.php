@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')


    <div class="content-wrapper">
        <div class="container-fluid">
            <a href="{{ url()->previous()  }}"><< Back</a>
            <!--states start-->
            <div class="row">
                <div class="col-xl-4 col-md-6 profile-info-position">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="mt-4 mb-3">
                                    <img class="rounded-circle" src="/assets/img/avatar/avatar2.jpeg" width="85" alt="">
                                </div>
                                <h5 class="text-uppercase mb-0">{{ $user->first_name }} {{ $user->last_name }}</h5>
                                <p class="text-muted mb-0">{{ $user->email }} </p>
                                <p class="text-muted mb-0">{{ $user->phone_no }} </p>

                            </div>

                        </div>
                    </div>

                    <div class="card card-shadow mb-4">

                        <div class="card-body">
                            <div class="row f12 mb-3">
                                <div class="col-6">Country</div>
                                <div class="col-6">
                                    {{ optional($user->country_residence)->nicename }}
                                </div>
                            </div>
                            <div class="row f12 mb-3">
                                <div class="col-6">Platform Name</div>
                                <div class="col-6">
                                    {{ $user->platform_name }}
                                </div>
                            </div>
                            <div class="row f12 mb-3">
                                <div class="col-6">Company Name</div>
                                <div class="col-6">
                                    {{ $user->company }}
                                </div>
                            </div>
                            <div class="row f12">
                                <div class="col-6">Name of MD</div>
                                <div class="col-6">
                                    {{ $user->director }}
                                </div>
                            </div>
                            <div class="row f12">
                                <div class="col-6">Certification No</div>
                                <div class="col-6">
                                    {{ $user->certified_no }}
                                </div>
                            </div>
                            <div class="row f12">
                                <div class="col-6">Referral Fee</div>
                                <div class="col-6">
                                    {{ ($user->referral_fee) ? $user->referral_fee : "5" }}%
                                </div>
                            </div>
                            @if($user->c_o_i)
                                <div class="row f12 mt-3">
                                    <div class="col-6">CAC Document:</div>
                                    <div class="col-6">
                                        <a href="{{ url($user->c_o_i) }}" target="_blank">Download</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="col-xl-8 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body table-responsive">
                                    @if($user->main_agent_id)
                                        <div class="alert alert-danger">This user isn't a super agent.</div>
                                    @else
                                        <h5 class="card-title">Sub Agents</h5>
                                        <p class="card-text">
                                        @if($agents->total() > 0)
                                            <table class="table table-bordered">
                                                <thead>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>My %</th>
                                                <th>SuperAgent's %</th>
                                                </thead>
                                                <tbody>
                                                @foreach($agents as $agent)
                                                    <tr>
                                                        <td>{{ $agent->first_name }}</td>
                                                        <td>{{ $agent->last_name }}</td>
                                                        <td>{{ $agent->email }}</td>
                                                        <td>{{ 100 - $agent->main_agent_share_raw }}</td>
                                                        <td>{{ $agent->main_agent_share_raw }}</td>
                                                    </tr>

                                                @endforeach
                                                </tbody>
                                            </table>
                                            @endif

                                            </p>
                                        @endif
                                </div>
                            </div>
                            <br>

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
            $('#data_table').DataTable();
        });
    </script>
@endsection