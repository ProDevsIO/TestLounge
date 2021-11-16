@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            
              
         
            <div class="rows">
                            <div class="card-title p-2">
                               <h3> Edit Supported Countries Setup</h3>
                            </div>
                            @include('errors.showerrors')
                <div clas="col-md-12">
                    <form action="{{url('/edit/configure/data')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <label for=""><b>Country</b></label>
                               

                                <select name="country_id" class="form-control" id="country" onchange ="getVendorCountry()" required>
                                    <option value="">Please select a country</option>
                                
                                        <option value="{{$countries->country_id}}" selected>{{$countries->country->nicename}}</option>
                               
                                </select>
                                <br>
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-title p-3">
                               <h5><b>Image</b></h5>
                            </div>
                            <div class="card-body">
                                <img id="blah" src="{{url('/page_img/'.$countries->image)}}" class="img-thumbnail img-fluid mx-auto d-block " width="50%" alt="View Image here" />
                                <br><br>
                                <input type="file" name="image" class="form-control" id="imgInp">
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-title p-3">
                               <h5> Page Information </h5>
                            </div>
                            <div class="card-body">

                                <label for=""><b>On arrival (If fully vaccinated)</b></label>
                                <textarea name="arrival_vaccinated" id="" class="form-control arrival_vaccinated" cols="30" rows="10" >{{ old('arrival_vaccinated') ?? $countries->arrival_vaccinated}}</textarea>
                                <br>

                                <label for=""><b>On arrival(If Unvaccinated / Partially vaccinated)</b></label>
                                <textarea name="arrival_unvaccinated" id="" class="form-control arrival_unvaccinated" cols="30" rows="10">{{ old('arrival_unvaccinated') ?? $countries->arrival_unvaccinated}}</textarea>
                                <br>

                                <label for=""><b>Predeparture(If fully vaccinated)</b></label>
                                <textarea name="departure_vaccinated" id="" class="form-control departure_vaccinated" cols="30" rows="10">{{ old('departure_vaccinated') ?? $countries->departure_vaccinated}}</textarea>
                                <br>

                                <label for=""><b>Predeparture(If Unvaccinated / Partially vaccinated)</b></label>
                                <textarea name="departure_unvaccinated" id="" class="form-control departure_unvaccinated" cols="30" rows="10">{{ old('departure_unvaccinated') ?? $countries->departure_unvaccinated}}</textarea>
                                <br>

                                <label for=""><b>Faq</b></label>
                                <textarea name="faq" id="" class="form-control faq" cols="30" rows="10">{{old('faq') ?? $countries->faq}}</textarea>
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
        $(document).ready(function() {

            $('.arrival_vaccinated').summernote({
                
                height:300,
                placeholder: 'please fill this box...'

            });

        });

        $(document).ready(function() {

            $('.arrival_unvaccinated').summernote({
                
                height:300,
                placeholder: 'please fill this box...'

            });

        });

        $(document).ready(function() {

            $('.departure_unvaccinated').summernote({
                
                height:300,
                placeholder: 'please fill this box...'

            });

        });

        $(document).ready(function() {

            $('.departure_vaccinated').summernote({
                
                height:300,
                placeholder: 'please fill this box...'

            });

        });

        $(document).ready(function() {

            $('.faq').summernote({
                
                height:200,
                placeholder: 'please fill this box...'

            });

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

        function getVendorCountry()
        {
         
            var country_id = document.getElementById('country').value;
           

            var url = '/vendor/supported/' + country_id;

            $.get(url, function (data) {
                var $el = $(".vendor");
                $el.empty(); // remove old options
                console.log(data);
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

        function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function(){
                readURL(this);
            });

    </script>
@endsection