@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            
              
         
            <div class="rows">
                            <div class="card-title p-2">
                               <h3> Supported countries setup</h3>
                            </div>
                <div clas="col-md-12">
                    <form action="{{url('page/configure/data')}}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <label for="">Country</label>
                                <select name="country_id" class="form-control" id="country" onchange ="getVendorCountry()" required>
                                    <option value="">Please select a country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->nicename}}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-title p-3">
                               <h5>Vendor</h5>
                            </div>
                            <div class="card-body">
                                <label for="">Vendor</label>
                                <select name="vendor_id" id="" class="form-control vendor" required></select>
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-title p-3">
                               <h5> Page Information </h5>
                            </div>
                            <div class="card-body">

                                <label for="">On arrival</label>
                                <textarea name="on_arrival" id="" class="form-control" cols="30" rows="10" required></textarea>
                                <br>

                                <label for="">Predeparture</label>
                                <textarea name="departure" id="" class="form-control" cols="30" rows="10" required></textarea>
                                <br>

                                <label for="">Faq</label>
                                <textarea name="faq" id="" class="form-control" cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                        <br>
                       <input type="submit" class="btn btn-md btn-info" value="submit">
                    </form>
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

        function getVendorCountry()
        {
         
            var country_id = document.getElementById('country').value;
           

            var url = '/vendor/supported/' + country_id;

            $.get(url, function (data) {
                var $el = $(".vendor");
                $el.empty(); // remove old options
                if(data != "error")
                {
                    $el.append($("<option value=''>Select a Vendor</option>"));
                    
                    $.each(data, function (key, value) {
                        $el.append($("<option></option>")
                            // .attr("value", value.vendor_id).text(value.name + "(" + value.price + ")"));
                            .attr("value", value.vendor_id).text(value.name ));
                    });
                }else{
                    $el.append($("<option value=''>No vendor is supported for this country</option>"));
                }

            });
        }

    </script>
@endsection