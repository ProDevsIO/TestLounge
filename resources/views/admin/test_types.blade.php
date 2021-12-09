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
                        <form method="post" action="{{ url('/add/colors') }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Country color zone</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <label>Country</label>
                            <select name="country" class="form-control" id="">
                                <option value="">Select a country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->nicename}}</option>
                                @endforeach
                            </select>
                            <label>Color</label>
                            <select name="color" class="form-control" id="">
                            <option value="">Select a color</option>
                                @foreach($colors as $color)
                                    <option value="{{$color->id}}">{{$color->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Color</button>
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
                                    @foreach($countryzone as $zone)
                                        <tr>
                                            <td>
                                                {{ $zone->country['name']}}
                                            </td>
                                            <td>
                                            {{ $zone->color['name']}}
                                            </td>
                                            @if(auth()->user()->type == "1")
                                                <td>
                                                        <a data-toggle="modal"
                                                           data-target="#editModal{{ $zone->id }}"
                                                           href="javascript:;"
                                                           class="btn btn-sm btn-info">Edit</a>
                                        
                                                        <a href="#" onclick="delete_zone('{{ $zone->id }}')"
                                                           class="btn btn-sm btn-danger">Delete</a>
                                            
                                                </td>
                                            @endif
                                        </tr>

                                        <div class="modal fade" id="editModal{{ $zone->id }}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/edit/colors/{{$zone->id}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $zone->id }}"/>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                Color Zone</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                           <label>Color</label>
                                                           <select name="color" class="form-control"  id="">
                                                           @foreach($colors as $color)
                                                                <option value="{{$color->id}}"
                                                                @if($color->id == $zone->color_id)
                                                                    selected
                                                                @endif > {{$color->name}}</option>
                                                               @endforeach
                                                           </select>
                                                        
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

        function delete_zone(id){
            var d = confirm("Are you sure you want to delete this test type?");
            if(d){
                window.location = "/delete/test/type/" + id;
            }
        }
    </script>
@endsection