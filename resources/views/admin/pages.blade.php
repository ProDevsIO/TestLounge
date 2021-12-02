@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    {{--<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">--}}
    
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
                                    <div class="custom-title">Pages  <a type="button" class="btn btn-info btn-md pull-right" href="javascript:;"  data-toggle="modal" data-target="#addPage"> Add page</a></div>
    
                                </div>
                            </div>
                            <div class="card-body p-0">
                        
                                <div class="table-responsive">
                                    <table class="table table-hover table-custom" id="data_table">
                                        <thead>
                                        <tr>
                                            <td>Title</td>
                                            <td>Type</td>
                                            <td>Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pages as $page)
                                           <tr>
                                                <td>{{$page->title}}</td>
                                                <td>@if($page->type == 1)
                                                        Modal
                                                    @else
                                                        Page
                                                    @endif
                                                </td>
                                                <td>
                                                            <div class="btn-group" role="group">
                                                                <button id="btnGroupDrop1" type="button"
                                                                        class="btn btn-primary dropdown-toggle btn-sm"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                    @if($page->type == 2)
                                                            
                                                                        <a class="dropdown-item" href="{{ url('/view/page/'.$page->id)}}">View</a>

                                                                        @endif  
                                                                        <a class="dropdown-item" data-toggle="modal" data-target="#editPage{{$page->id}}">Edit</a>
                                                                </div>
                                                            </div>
                                                </td>
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
                                                    <div class="modal fade" id="addPage"
                                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{ url('/page/save') }}"
                                                                      method="post">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Add Page</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <label>Title</label>
                                                                        <input type="text" name="title"
                                                                               class="form-control" value="{{ old('title') }}" required
                                                                               >
                                                                        <br>
                                                                        <label for="">Content</label>
                                                                        <textarea name="content" id="" class="form-control arrival_vaccinated"
                                                                                    cols="10" rows="10" required> {{ old('content') }} </textarea>

                                                                        <br>
                                                                        <label for="">Type</label>
                                                                        <select name="type" id="" class="form-control" required>
                                                                            <option value="">Please select a page type</option>
                                                                            <option value="Normal ">Normal page</option>
                                                                            <option value="Modal">Modal</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close
                                                                        </button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Save changes
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @foreach($pages as $page)
                                                        <div class="modal fade" id="editPage{{$page->id}}"
                                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <form action="{{ url('/page/edit/'.$page->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                                Add Page</h5>
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <label>Title</label>
                                                                            <input type="text" name="title"
                                                                                class="form-control" value="{{old('title') ?? $page->title}}" required
                                                                                >
                                                                            <br>
                                                                            <label for="">Content</label>
                                                                            <textarea name="econtent{{$page->id}}" id="" class="form-control"
                                                                                        cols="10" rows="10" required>{{old('econtent') ?? $page->content}}</textarea>

                                                                            <br>
                                                                            <label for="">Type</label>
                                                                            <select name="type" id="" class="form-control" required>
                                                                                <option value="">Please select a page type</option>
                                                                               
                                                                                <option value="Normal " @if((old('type') ?? $page->type) == 2) selected @endif>Normal page</option>
                                                                                <option value="Modal"  @if((old('type') ?? $page->type) == 1) selected @endif>Modal</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close
                                                                            </button>
                                                                            <button type="submit" class="btn btn-primary">
                                                                                Save changes
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
@endsection
@section('script')
<script src="/assets/vendor/data-tables/jquery.dataTables.min.js"></script>
<script src="/assets/vendor/data-tables/dataTables.bootstrap4.min.js"></script>
 <script src="https://cdn.ckeditor.com/4.17.1/standard-all/ckeditor.js"></script>
    <script>
         $(document).ready(function () {
            $('#data_table').DataTable({
                "order": []
            });
        });
        $(document).ready(function () {
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

       
            // editor.addCommand("mySimpleCommand", {
            //     exec: function(edt) {
            //         alert(edt.getData());
            //     }
            // });
            // editor.ui.addButton('SuperButton', {
            //     label: "Click me",
            //     command: 'mySimpleCommand',
            //     toolbar: 'insert',
            // });


            CKEDITOR.replace('content', settings);
            @foreach($pages as $page)
                CKEDITOR.replace('econtent{{$page->id}}', settings);
            @endforeach
           
         
        });


        function confirmation(url) {
            var d = confirm("Are you sure you want to perform this action?");

            if (d) {
                window.location = url;
            }
        }

    </script>
@endsection