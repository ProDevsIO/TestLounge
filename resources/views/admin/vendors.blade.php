@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/vendor_/jquery-toast-plugin/jquery.toast.min.css">
    @livewireStyles
@endsection
@section('content')


    <div class="content-wrapper">
        <div class="container-fluid">
            <!--employee data table-->
            <div class="row">
                <div class="col-xl-12 p-0">
                    @include('errors.showerrors')
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title">Currency Settings</div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                           <form action="{{ url('/settings') }}" method="post">
                               @csrf
                               <label>Exchange rate($)</label>
                               <input type="number" name="amount" class="form-control" value="{{ $amount->pounds }}"/>
                               
                               <br/>
                               <input type="submit" value="Update Settings" class="btn btn-primary"/>
                           </form>
                        </div>
                    </div>
                </div>
            
            
                <div class="col-xl-12 p-0" >
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title">Vendors </div>
                                <!-- <button class="btn btn-info pull-right" data-toggle="modal" data-target="#addVendor"> Add Vendor</button> -->
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                @if($vendors->count() > 0)
                                    <table class="table table-hover table-custom" id="data_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Bookings</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($vendors as $vendor)
                                            <tr>
                                                <td>
                                                    {{ $vendor->id }}
                                                </td>
                                                <td>{{ $vendor->name }}</td>
                                                <td>{{ $vendor->bookings->count() }}</td>
                                                <td>
                                                    <a href="{{ url('complete/booking?vendor_id='.$vendor->id) }}"
                                                       class="btn btn-info btn-sm">View Bookings</a>
                                                    <a href="#"
                                                       data-toggle="modal" data-target="#viewProductModal{{ $vendor->id }}" class="btn btn-danger btn-sm">View Products</a>
                                                </td>
                                            </tr>

                                           
                                        @endforeach

                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-danger">No Vendor has been created. Kindly Create one.<br/>
                                        <a href="javascript:;" data-toggle="modal" data-target="#addVendor"
                                           class="btn btn-danger">Add Vendor</a></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ url('/add/vendor') }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add a Vendor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <label>Name</label>
                                <input type="text" name="name" placeholder="Please fill in the vendor name" class="form-control">
                                <br>
                                <label>Email</label>
                                <input type="email" name="email"  placeholder="Please fill in the vendor email"  class="form-control" id=""  required>
                                <br>
                                <label>Address</label>
                                <textarea class="form-control" name="address" id="" cols="30" rows="10"required>Please fill in your address</textarea>
                

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if($vendors->count() > 0)
             @foreach($vendors as $vendor)
             <div class="modal fade" id="viewProductModal{{ $vendor->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">View Products</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @livewire('add-product-vendor',['vendor_id' => $vendor->id, 'pound_price' => $setting->pounds])
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
             @endforeach
        @endif
        <!--footer-->
    @include('includes.footer ')
    <!--/footer-->
    </div>

    <div class="modal fade" id="vendorModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title "><b>Create a vendor</b></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="/vendor/create" method="POST">
            <div class="modal-body">
                <div class="container">
                    
                        <input type="text" name="name" placeholder="Please fill in the vendor name" class="form-control" id="" required>
                        <br>
                        <input type="email" name="email"  placeholder="Please fill in the vendor email"  class="form-control" id=""  required>
                        <br>
                        <textarea class="form-control" name="address" id="" cols="30" rows="10"required>Please fill in your address</textarea>
                
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
</div>

@endsection
@section('script')
    <script src="/assets/vendor/data-tables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/data-tables/dataTables.bootstrap4.min.js"></script>
    <script src="/vendor_/jquery-toast-plugin/jquery.toast.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#data_table').DataTable();
        });

        resetToastPosition = function () {
            $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
            $(".jq-toast-wrap").css({
                "top": "",
                "left": "",
                "bottom": "",
                "right": ""
            }); //to remove previous position style
        }

        window.addEventListener('toastMessage', event => {
            resetToastPosition();
            $.toast({
                heading: event.detail.heading,
                text: event.detail.message,
                showHideTransition: 'slide',
                icon: event.detail.type,
                loaderBg: '#f96868',
                position: 'top-right'
            })
        });

    </script>



    @livewireScripts
@endsection