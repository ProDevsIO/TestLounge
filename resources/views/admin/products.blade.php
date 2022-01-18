@extends('layouts.admin')
@section('style')

@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
                <h4 class="page-title">Products</h4>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container-fluid">

            <!--states start-->
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card mb-4 bg-purple" title="Pending bookings">
                        <div class="card-body">
                            <div class="media d-flex align-items-center ">
                                <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                    <i class="vl_book"></i>
                                </div>
                                <div class="media-body text-light" title="Pending bookings">
                                    <h4 class="text-uppercase mb-0 weight500">{{ $products->count() }}</h4>
                                    <span class="text-black">All Products</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="{{ url('/add/product') }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <label>Name</label>
                            <input type="text" class="form-control"
                                   value="{{ old('name') }}" name="name" required>

                            <label>Description</label>
                            <input type="text" class="form-control"
                                   value="{{ old('description') }}" name="description" required>

                                   <label class="mt-2">Test type</label>
                                                            <select name="classify" class="form-control" id="type" required>
                                                                <option value="">Kindly select a type </option>

                                                                    <option value="0">

                                                                          Individual Test

                                                                    </option>
                                                                    <option value="1">

                                                                            Bundle Test

                                                                    </option>

                                                            </select>
                            <div style="display:none">
                               <label for="">Country</label>
                                <select name="country_id" class="form-control" id="country" required>


                                        <option value="255" selected>United Kingdom</option>

                                </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Product</button>
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
                                <div class="custom-title">Products</div>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addProduct" class="btn btn-danger " style="float: right;margin-top: -20px;">Add Product</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-custom" id="data_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Booking</th>
                                        <th scope="col">Test Type</th>
                                        <!-- <th scope='col'>Country</th> -->
                                        <th scope="col">Links</th>
                                        @if(auth()->user()->type == "1")
                                            <th scope="col">Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                {!! $product->description !!}
                                            </td>
                                            <td>{{ $product->bookings->count() }}</td>
                                            <!-- <td>{{optional($product->country)->nicename ?? "No country"}}</td> -->
                                            <td>    @if($product->classify == 0 )
                                                        <label class="badge badge-warning text-white">Individual</label>
                                                    @elseif($product->classify == 1 )
                                                        <span class="badge badge-info  text-white"> Bundle</span>
                                                    @endif
                                                </td>
                                            <td>@if(optional($product)->slug)
                                                   <a href="view/product/{{$product->slug}}">view/product/{{optional($product)->slug}}</a>
                                                @else
                                                    No Links
                                                @endif
                                            </td>
                                            @if(auth()->user()->type == "1")
                                                <td>

                                                        <a data-toggle="modal"
                                                           data-target="#editModal{{ $product->id }}"
                                                           href="javascript:;"
                                                           class="btn btn-info">Edit</a>
                                                        <a href="{{ url('/view/bookings/'.$product->id) }}"
                                                           class="btn btn-info">View Booking</a>
                                                    @if($product->bookings->count() == 0)
                                                        <a href="#" onclick="delete_product('{{ $product->id }}')"
                                                           class="btn btn-danger">Delete</a>
                                                    @endif
                                                </td>
                                            @endif
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
        @foreach($products as $product)
        <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog " role="document">
                                                <div class="modal-content">
                                                    <form action="/edit/product" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $product->id }}"/>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                Product</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <label>Name</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{ $product->name }}" name="name">
                                                            <label class="mt-2">Description</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{ $product->description }}" name="description" required>
                                                            <label class="mt-2">Test type</label>
                                                            <select name="Type" class="form-control" id="type" required>
                                                                <option value="">Kindly select a type </option>

                                                                    <option value="0" @if($product->classify == 0 ) selected @endif>
                                                                        @if($product->classify == 0 )
                                                                          Individual Test
                                                                        @endif
                                                                    </option>
                                                                    <option value="1"  @if($product->classify == 1 ) selected @endif>
                                                                        @if($product->classify == 1 )
                                                                            Bundle Test
                                                                        @endif
                                                                    </option>

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

        function delete_product(id){
            var d = confirm("Are you sure you want to delete this product?");
            if(d){
                window.location = "/delete/product/" + id;
            }
        }
    </script>
@endsection
