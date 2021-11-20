@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    {{--<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">--}}
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            
              
         
            <div class="rows" style="padding-bottom:30px">
                            <div class="card-title p-2">
                               <h3> Supported countries setup</h3>
                            </div>
                            @include('errors.showerrors')
                <div clas="col-md-12">
                    <form action="{{url('page/configure/data')}}" method="POST" enctype="multipart/form-data">
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
                               <h5> Page Information </h5>
                            </div>
                            <div class="card-body">
                                 <label for=""><b>Page Image</b></label>
                                 <input type="file" name="image" class="form-control" src="" alt="">

                                <br>
                                <label for=""><b>On arrival (If fully vaccinated)</b></label>
                                <textarea name="arrival_vaccinated" id="" class="form-control arrival_vaccinated" cols="30" rows="10"></textarea>
                                <br>

                                <label for=""><b>On arrival(If Unvaccinated / Partially vaccinated)</b></label>
                                <textarea name="arrival_unvaccinated" id="" class="form-control arrival_unvaccinated" cols="30" rows="10"></textarea>
                                <br>

                                <label for=""><b>Predeparture(If fully vaccinated)</b></label>
                                <textarea name="departure_vaccinated" id="" class="form-control departure_vaccinated" cols="30" rows="10"></textarea>
                                <br>

                                <label for=""><b>Predeparture(If Unvaccinated / Partially vaccinated)</b></label>
                                <textarea name="departure_unvaccinated" id="" class="form-control  departure_unvaccinated" cols="30" rows="10"></textarea>
                                <br>

                                <label for=""><b>Faq</b></label>
                                <textarea name="faq" id="" class="form-control faq" cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                        <br>
                       <input type="submit" class="btn btn-md btn-info pull-right"  value="Add Country">
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {

            CKEDITOR.replace( 'arrival_vaccinated' );
            CKEDITOR.replace( 'arrival_unvaccinated' );
            CKEDITOR.replace( 'departure_unvaccinated' );
            CKEDITOR.replace( 'departure_vaccinated' );
            CKEDITOR.replace( 'faq' );
            CKEDITOR.replace( 'arrival_vaccinated' );

        });




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

        // function getVendorCountry()
        // {
         
        //     var country_id = document.getElementById('country').value;
           

        //     var url = '/vendor/supported/' + country_id;

        //     $.get(url, function (data) {
        //         var $el = $(".vendor");
        //         $el.empty(); // remove old options
        //         console.log(data);
        //         if(data != "error")
        //         {
        //             $el.append($("<option value=''>Select a Vendor</option>"));
                    
        //             $.each(data, function (key, value) {
        //                 $el.append($("<option></option>")
        //                     // .attr("value", value.vendor_id).text(value.name + "(" + value.price + ")"));
        //                     .attr("value", value.vendor_id).text(value.name ));
        //             });
        //         }else{
        //             $el.append($("<option value=''>No vendor is supported for this country</option>"));
        //         }

        //     });
        // }

    </script>
@endsection