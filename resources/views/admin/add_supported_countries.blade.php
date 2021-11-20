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
            var settings = {
                toolbar: [{
                    name: 'document',
                    items: ['Print']
                },
                    {
                        name: 'clipboard',
                        items: ['Undo', 'Redo']
                    },
                    {
                        name: 'styles',
                        items: ['Format', 'Font', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    },
                    {
                        name: 'align',
                        items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                    },
                    '/',
                    {
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting']
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
                    },
                    {
                        name: 'insert',
                        items: ['Image', 'Table']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    },
                    {
                        name: 'editing',
                        items: ['Scayt']
                    }
                ],

                extraAllowedContent: 'h3{clear};h2{line-height};h2 h3{margin-left,margin-top}',

                // Adding drag and drop image upload.
                extraPlugins: 'print,format,font,colorbutton,justify,uploadimage',
                height: 560,
                removeDialogTabs: 'image:advanced;link:advanced',
                removeButtons: 'PasteFromWord'
            }

            CKEDITOR.replace( 'arrival_vaccinated',settings );
            CKEDITOR.replace( 'arrival_unvaccinated',settings );
            CKEDITOR.replace( 'departure_unvaccinated',settings );
            CKEDITOR.replace( 'departure_vaccinated' ,settings);
            CKEDITOR.replace( 'faq',settings );
            CKEDITOR.replace( 'arrival_vaccinated' ,settings);b

        });




        function confirmation(url) {
            var d = confirm("Are you sure you want to perform this action?");

            if (d) {
                window.location = url;
            }
        }

    </script>
@endsection