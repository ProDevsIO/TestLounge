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
                                <img id="blah" src="{{url($countries->image)}}" class="img-thumbnail img-fluid mx-auto d-block " width="50%" alt="View Image here" />
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
                       <input type="submit" class="btn btn-md btn-info" value="Edit Country">
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
    <script src="https://cdn.ckeditor.com/4.17.1/standard-all/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            var settings = {
                on: {
                    pluginsLoaded: function () {
                        var editor = this,
                            config = editor.config;

                        editor.ui.addRichCombo('my-combo', {
                            label: 'Add Product(s)',
                            title: 'Add Product(s)',
                            toolbar: 'basicstyles,0',

                            panel: {
                                css: [CKEDITOR.skin.getPath('editor')].concat(config.contentsCss),
                                multiSelect: false,
                                attributes: {'aria-label': 'Add Product(s)'}
                            },

                            init: function () {
                                this.startGroup('Options');
                                this.add('<a href="all">Book COVID Tests</a>', 'Add all Country Test!');
                                @foreach($products as $product)
                                    this.add('<a href="{{ env("APP_URL")."view/product/".$product->slug }}">Book {{ $product->name }}</a>', '{{ $product->name }}');
                                @endforeach
                                this.add('<a href="loop">All Test(s)</a>', 'Loop all Country Test!')
                            },

                            onClick: function (value) {
                                editor.focus();
                                editor.fire('saveSnapshot');

                                editor.insertHtml(value);

                                editor.fire('saveSnapshot');
                            }
                        });
                    }
                },
                extraAllowedContent: 'h3{clear};h2{line-height};h2 h3{margin-left,margin-top}',

                // Adding drag and drop image upload.
                extraPlugins: 'print,format,font,colorbutton,justify,uploadimage',
                height: 560,
                removeDialogTabs: 'image:advanced;link:advanced',
                removeButtons: 'PasteFromWord'
            };

            CKEDITOR.replace( 'arrival_vaccinated',settings );
            CKEDITOR.replace( 'arrival_unvaccinated',settings );
            CKEDITOR.replace( 'departure_unvaccinated',settings );
            CKEDITOR.replace( 'departure_vaccinated' ,settings);
            CKEDITOR.replace( 'faq',settings );
            CKEDITOR.replace( 'arrival_vaccinated' ,settings);

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