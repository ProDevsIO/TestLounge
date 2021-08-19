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
                            <h3 class="text-center mb-3">Create Sub Agent Account</h3>
                            @include('errors.showerrors')
                            <form action="{{ route("sub-agents.store") }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" value="" name="first_name" class="form-control"
                                        placeholder="First Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" value="" name="last_name" class="form-control"
                                        placeholder="Last Name" required>
                                </div>
                                <div class="form-group">
                                    <input id="phone" style="width:100%;margin-right:0px" type="text" value=""
                                        name="phone_no" class="form-control pr-5" placeholder="Phone No" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" value="" name="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <small class="text-muted">Please let us know what name you would like displayed on the
                                        UK Travel Test portal. </small>
                                    <input type="text" value="" name="platform_name" class="form-control"
                                        id="exampleInputEmail1" placeholder="Name on platform">
                                </div>
                                <div class="form-group">
                                    <input type="text" value="" name="company" class="form-control" id="exampleInputEmail1"
                                        placeholder="Name of organization" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" value="" name="director" class="form-control" id="exampleInputEmail1"
                                        placeholder="Name of managing director" required>
                                </div>
                                <div class="form-group">
                                    <small class="text-muted">If available</small>
                                    <label style="width:100%">Certificate of incorporation</label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <div class="form-group ">
                                    <select name="certified" class="form-control" id="" required>
                                        <option class="pl-5" value="">Is this Sub Agent IATA certified?</option>
                                        <option class="text-center" value="Yes">Yes</option>
                                        <option class="text-center" value="No ">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <small class="text-muted">If certified</small>
                                    <input type="text" value="" name="certified_no" class="form-control"
                                        id="exampleInputEmail1" placeholder="Please fill in your IATA number">
                                </div>

                                <div class="form-group">
                                    <small class="text-muted">Your Percentage Share</small>
                                    <input type="range" value="0" name="my_share" class="form-control" min="0" max="100"
                                        id="exampleInputEmail1" placeholder="How much percent would you take for yourself?"  onInput="$('#rangeval').html($(this).val())" required>
                                    <span id="rangeval">0</span>%
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
