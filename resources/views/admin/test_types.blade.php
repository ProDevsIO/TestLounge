@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">

            <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="{{ url('/add/test/type') }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Country color zone</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <label>Test type name</label>
                            
                            <input type="text" name="test_type" class="form-control" id="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Test Type</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--employee data table-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title">Test type</div>
                                <a href="javascript:;" data-toggle="modal" data-target="#addProduct" class="btn btn-info pull-right">Add Test type</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                        @include('errors.showerrors')
                            <div class="table-responsive">
                                <table class="table table-hover table-custom" id="data_table">
                                    <thead>
                                    <tr>
                                            <th scope="col">Test types</th>
                                        @if(auth()->user()->type == "1")
                                            <th scope="col">Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($test_types as $type)
                                        <tr>
                                            <td>
                                                {{ $type->test_type}}
                                            </td>
                                            
                                            @if(auth()->user()->type == "1")
                                                <td>
                                                        <a data-toggle="modal"
                                                           data-target="#editModal{{ $type->id }}"
                                                           href="javascript:;"
                                                           class="btn btn-sm btn-info">Edit</a>
                                        
                                                        <!-- <a href="#" onclick="delete_('{{ $type->id }}')"
                                                           class="btn btn-sm btn-danger">Delete</a> -->
                                            
                                                </td>
                                            @endif
                                        </tr>

                                        <div class="modal fade" id="editModal{{ $type->id }}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/edit/test/type/{{$type->id}}" method="post">
                                                        @csrf
                                                        
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                Test types</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                           <label>Name</label>
                                                           <input type="text" name="test_type" required class="form-control" value="{{$type->test_type}}">
                                                        
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Update
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
    @include('includes.footer ')
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

        function delete_(id){
            var d = confirm("Are you sure you want to delete this test type?");
            if(d){
                window.location = "/delete/test/type/" + id;
            }
        }
    </script>
@endsection