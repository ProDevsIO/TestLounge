@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
               
                @include('errors.showerrors')
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-shadow mb-4 ">
                            <div class="card-header border-0">
                                
                                <div class="custom-title-wrap border-0 position-relative pb-2">
                                    <div class="custom-title">Supported countries  <a type="button" class="btn btn-info btn-md pull-right" href="/add/supported/countries">Add supported country</a></div>
    
                                </div>
                            </div>
                            <div class="card-body p-0">
                        
                                <div class="table-responsive">
                                    <table class="table table-hover table-custom" id="data_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Country</th>
                                            <th scope="col">Vendor</th>
                                            @if(auth()->user()->type == "1")
                                                <!-- <th scope="col">Action</th> -->
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($countries as $country)
                                            <tr>
                                            <td>{{$country->country->nicename}}</td>
                                            <td>{{$country->vendor->name}}</td>
                                            <!-- <td><button>action</button></td> -->
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
        $(document).ready(function () {
            $('#data_table1').DataTable({
                "order": []
            });
        });
       

        function confirmation(url) {
            var d = confirm("Are you sure you want to perform this action?");

            if (d) {
                window.location = url;
            }
        }

    </script>
@endsection