@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')


    <div class="content-wrapper">

        <div class="container-fluid">

            <!--states start-->
            <div class="row">
                <div class="col-xl-12 col-md-12 profile-info-position">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-body">
                            <h3 class="text-center mb-3">Create Sub-Agent Account</h3>
                            @include('errors.showerrors')
                            <form action="{{ route("sub-agents.store") }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" value="{{ old('first_name') }}" name="first_name" class="form-control"
                                        placeholder="First Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" value="{{ old('last_name') }}" name="last_name" class="form-control"
                                        placeholder="Last Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter Email" required>
                                </div>
                                <p> Super Agent has {{ $user->percentage_split ?? $setting->value}} %</p>

                                <div class="form-group">
                                    <small class="text-muted">Your Percentage Share</small>
                                    <input type="number" class="form-control" step="0.25" value="{{ old('my_share') }}" name="my_share">
                                    
                                </div>


                                <p class="text-danger">
                                   <b> An email containing the login credentials will be sent to the email provided above. Kindly ensure that it is correct!</b>
                                </p>


                                <div class="form-group clearfix">
                                    <button type="submit" class="btn btn-purple btn-pill float-right">Create</button>
                                </div>

                            </form>

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
        $(document).ready(function() {
            $('#data_table').DataTable();
        });
    </script>
@endsection
