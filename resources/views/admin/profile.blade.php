@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')


    <div class="content-wrapper">
   
        <div class="container-fluid">
           
            <!--states start-->
            <div class="row">
                <div class="col-xl-4 col-md-4 profile-info-position">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-body">
                            <div class="text-center">
                                <!-- <div class="mt-5 mb-3">
                                    <img class="rounded-circle" src="/assets/img/avatar/avatar2.jpeg" width="100" alt="">
                                </div> -->
                                <h1 class="text-uppercase mt-2">{{ $users->first_name }} {{ $users->last_name }}</h1>
                                <p class="text-muted mt-2">{{ $users->email }} </p>

                            </div>

                        </div>
                    </div>

                    

                </div>
                <div  class="col-xl-8 col-md-8 profile-info-position">
                    <div class="card card-shadow mb-4">
                        <div class="card-body">
                            <div class="row f12 mb-3">
                                <div class="col-6">Phone number</div>
                                <div class="col-6">
                                    @if($users->phone_no != null)
                                    {{$users->phone_no}}
                                    @else
                                    <span class="badge badge-danger">Please update</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row f12 mb-3">
                                <div class="col-6">Date of Birth</div>
                                <div class="col-6">
                                {{ \Carbon\Carbon::parse($users->dob)->toDateString() }}
                                </div>
                            </div>
                            <div class="row f12 mb-3">
                                <div class="col-6">Name of Organisation</div>
                                <div class="col-6">
                                    @if($users->company != null)
                                    {{$users->company}}
                                    @else
                                    <span class="badge badge-danger">Please update</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row f12 mb-3">
                                <div class="col-6">Managing Director</div>
                                <div class="col-6">
                                    @if($users->director != null)
                                    {{$users->director}}
                                    @else
                                    <span class="badge badge-danger">Please update</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row f12 mb-3">
                                <div class="col-6">Certified</div>
                                <div class="col-6">
                                    @if($users->certified != null)
                                    {{$users->certified}}
                                    @else
                                    <span class="badge badge-danger">Please update</span>
                                    @endif
                                </div>
                            </div>
                            @if( $users->certified == "Yes")
                            <div class="row f12 mb-3">
                                <div class="col-6">Certified number</div>
                                <div class="col-6">
                                    @if($users->certified_no != null)
                                    {{$users->certified_no}}
                                    @else
                                    <span class="badge badge-danger">Please update</span>
                                    @endif
                                </div>
                            </div>
                            @endif
                            <div class="row f12 mb-3">
                                <div class="col-6">Platform name</div>
                                <div class="col-6">
                                @if($users->platform_name != null)
                                {{ $users->platform_name}}
                                @else
                                <span class="badge badge-danger"> Please update</span>
                                    @endif
                                </div>
                            </div>
                            @if( $users->c_o_i != null)
                            <div class="row f12">
                                <div class="col-6">Certificate of incorporation</div>
                                <div class="col-6">
                                <a class ="btn btn-sm btn-outline-info" download href="{{$users->c_o_i}}"> Download to view</a> 
                                </div>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
               
            
            </div>
            <div class="mb-5">
                <a class="btn btn-md btn-outline-info pull-right" href="{{  url('/edit/profile/view') }}">Edit</a>    
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