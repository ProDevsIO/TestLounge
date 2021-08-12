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
                        <h3 class="text-center mb-3">Update your account details</h3>
                            @include('errors.showerrors')
                            <form action="{{ url('/edit/profile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" value="{{ $users->first_name}}" name="first_name" class="form-control" placeholder="First Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" value="{{ $users->last_name }}" name="last_name" class="form-control"  placeholder="Last Name" required>
                                </div>
                                <div class="form-group">
                                    <input id="phone" style="width:100%;margin-right:0px" type="text" value="{{ $users->phone_no}}" name="phone_no" class="form-control pr-5"  placeholder="Phone No" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" value="{{ $users->email}}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <small class="text-muted">Please let us know what name you would like displayed on the UK Travel Test portal.  </small>
                                <input type="text" value="{{ $users->platform_name}}" name="platform_name" class="form-control" id="exampleInputEmail1" placeholder="Name on platform">
                                </div>
                                <div class="form-group">
                                    <input type="text" value="{{ $users->company}}" name="company" class="form-control" id="exampleInputEmail1" placeholder="Name of organization" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" value="{{ $users->director}}" name="director" class="form-control" id="exampleInputEmail1" placeholder="Name of managing director" required>
                                </div> 
                                <div class="form-group">
                                    <small class="text-muted">If available</small>
                                    <label style="width:100%">Certificate of incorporation</label>
                                <input type="file"  name="file" class="form-control" >
                                </div>
                                <div class="form-group " >
                                    <select name="certified" class="form-control" id="">
                                        <option  class="pl-5" value="">Are you IATA certified?</option>
                                        <option class="text-center" value="Yes" @if($users->certified == "Yes") selected @endif >Yes</option>
                                        <option class="text-center" value="No "@if($users->certified == "No") selected @endif >No</option>
                                    </select>   
                                </div>
                                <div class="form-group">
                                    <small class="text-muted">If certified</small>
                                <input type="text" value="{{ $users->certified_no}}" name="certified_no" class="form-control" id="exampleInputEmail1" placeholder="Please fill in your IATA number">
                                </div>
                                
                                
                                <div class="form-group clearfix">
                                    <button type="submit" class="btn btn-purple btn-pill float-right">Update</button>
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
        $(document).ready(function () {
            $('#data_table').DataTable();
        });
    </script>
@endsection