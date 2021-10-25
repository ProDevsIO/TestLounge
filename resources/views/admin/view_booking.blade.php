@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        video {
        max-width: 100%;
        height: auto;
        }
    </style>
@endsection
@section('content')


    <div class="content-wrapper">
        <div class="container-fluid">
            <a href="{{ url()->previous()  }}"><< Back</a>
            <!--states start-->
            <div class="row">
                <div class="col-xl-4 col-md-6 profile-info-position">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="mt-4 mb-3">
                                    <img class="rounded-circle" src="/assets/img/avatar/avatar2.jpeg" width="85" alt="">
                                </div>
                                <h5 class="text-uppercase mb-0">{{ $booking->first_name }} {{ $booking->last_name }}</h5>
                                <p class="text-muted mb-0">{{ $booking->email }} </p>
                                <p class="text-muted mb-0">{{ $booking->phone_no }} </p>

                            </div>

                        </div>
                    </div>

                    <div class="card card-shadow mb-4">

                        <div class="card-body">
                            <div class="row f12 mb-3">
                                <div class="col-6">Sex</div>
                                <div class="col-6">
                                    @if($booking->sex == "1")
                                        Male
                                    @elseif($booking->sex == "2")
                                        Female
                                    @endif
                                </div>
                            </div>
                            <div class="row f12 mb-3">
                                <div class="col-6">Date of Birth</div>
                                <div class="col-6">
                                   {{ \Carbon\Carbon::parse($booking->dob)->toDateString() }}
                                </div>
                            </div>
                            <div class="row f12 mb-3">
                                <div class="col-6">Ethnicity</div>
                                <div class="col-6">
                                    @if($booking->ethnicity == "1")
                                        White
                                    @elseif($booking->ethnicity == "2")
                                        Mixed/Multiple Ethnic groups
                                    @elseif($booking->ethnicity == "3")
                                        Asian/Asian British
                                    @elseif($booking->ethnicity == "4")
                                        Black/African/Caribbean/Black British
                                    @elseif($booking->ethnicity == "5")
                                        Other Ethnic Group
                                    @endif
                                </div>
                            </div>
                            <!-- <div class="row f12">
                                <div class="col-6">Vaccination Status</div>
                                <div class="col-6">
                                    @if($booking->vaccination_status == "1")
                                        Has not been vaccinated.
                                    @elseif($booking->vaccination_status == "2")
                                        Has received the first dose, but not the second.
                                    @elseif($booking->vaccination_status == "3")
                                        Has received both first and second dose.
                                    @endif
                                </div>
                            </div> -->
                            <div class="row f12">
                                <div class="col-6">Payment Method</div>
                                <div class="col-6">
                                @if($booking->mode_of_payment == 1)
                                                        Flutterwave
                                                    @elseif($booking->mode_of_payment == 2)
                                                        Stripe
                                                    @elseif($booking->mode_of_payment == 3)
                                                        Voucher Payment
                                                    @elseif($booking->mode_of_payment == 4)
                                                        Paystack
                                                    @elseif($booking->mode_of_payment == 5)
                                                        Vas
                                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row f12">
                                
                                <div class="col-6">Status</div>
                                <div class="col-6">
                                    @if($booking->status == "1")
                                        <span class="badge badge-success">Paid</span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>

                                    @endif
                                </div>
                            </div>

                            <div class="row f12 mt-3">
                                <div class="col-5">Products</div>
                                <div class="col-7">
                                    <ul>
                                    @foreach($booking_products as $booking_product)
                                        <li>{{ $booking_product->product->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="row f12 mt-3">
                                <div class="col-5">Booking Code</div>
                                <div class="col-7">
                                    <ul>
                                        
                                    @foreach(json_decode($booking->booking_code) as $code)
                                        <li>{{ $code}}</li>
                                     @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($booking->test_kit == null || $booking->test_kit == "[null]")
                        @if($booking->product != null)
                            @if($booking->product->product_id == 15)
                            <button class="btn btn-info" data-toggle="modal" data-target="#myModal">Update test kits</button>
                            @endif
                        @endif
                    @endif
                   
                    @if($booking->test_kit != null )
                    @if($booking->test_kit != "[null]")
                    <div class="card card-shadow mb-4 ">
                        <div class="card-body">
                           
                                <div class="row f12 mt-3">
                                    <div class="col-md-5">Test Kit Numbers</div>
                                    <div class="col-md-7">
                                        <ul>
                                        @foreach(json_decode($booking->test_kit) as $kit)
                                        <li>{{ $kit }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                    @endif
                    @endif
                </div>

                <div class="col-xl-8 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- <div class="card" >
                                <div class="card-body">
                                    <h5 class="card-title">Home Address</h5>
                                    <p class="card-text">
                                        <ul>
                                        <li>Address1: {{ $booking->address_1 }}</li>
                                        <li>Address2: {{ $booking->address_2 }}</li>
                                        <li>Home City: {{ $booking->home_town }}</li>
                                        <li>Home PostCode: {{ $booking->post_code }}</li>
                                        <li>Home Country: {{ optional($booking->homeCountry)->name }}</li>
                                    </ul>

                                    </p>
                                </div>
                            </div> -->
                            <br>
                            <div class="card" >
                                <div class="card-body">
                                    <h5 class="card-title">Isolation Address</h5>
                                    <p class="card-text">
                                    <ul>
                                        <li>Address1: {{ $booking->isolation_address }}</li>
                                        <li>Address2: {{ $booking->isolation_addres2 }}</li>
                                        <li>Home City: {{ $booking->isolation_town }}</li>
                                        <li>Home PostCode: {{ $booking->isolation_postal_code }}</li>
                                        <li>Home Country: {{ $booking->country->name }}</li>
                                    </ul>

                                    </p>
                                </div>
                            </div>
                            <br>
                            <div class="card" >
                                <div class="card-body">
                                    <h5 class="card-title">Travel Details</h5>
                                    <p class="card-text">
                                    <ul>
                                        <!-- <li>Document ID number: {{ $booking->document_id }}</li> -->
                                        <li>Arrival Date: {{ $booking->arrival_date }}</li>
                                        <li>Country Traveling From: {{ $booking->travelingFrom->name }}</li>
                                        <!-- <li>City From: {{ $booking->city_from }}</li> -->
                                        <li>Departure Date: {{ $booking->departure_date }}</li>
                                        <!-- <li>Last day you were in a country/territory that was not in a travel corridor arrangement with the UK: {{ $booking->last_day_travel }}</li>
                                        <li>Mode of Transportation: {{ $booking->method_of_transportation }}

                                            @if($booking->method_of_transportation == "1")
                                                Airplane
                                            @elseif($booking->method_of_transportation == "2")
                                                Vessel
                                            @elseif($booking->method_of_transportation == "3")
                                                Train
                                            @elseif($booking->method_of_transportation == "4")
                                                Road Vehicle
                                            @elseif($booking->method_of_transportation == "5")
                                                Other
                                            @endif
                                        </li>
                                        <li>Flight Number / Coach Number / Vessel Name: {{ $booking->transport_no }}</li> -->

                                    </ul>

                                    </p>
                                </div>
                            </div>
                            <br>
                            <div class="card" >
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <p>
                                            I understand that I am purchasing this test in line with the UK Government's travel requirements because<br><br>
                                         
                                            @if($booking->vaccinated == 'yes')
                                            
                                            I am fully Vaccinated but unable to show evidence of this
                                            
                                            @elseif($booking->vaccinated == 'fully')
                                            I am fully Vaccinated
                                             @else
                                            I am not fully vaccinated
                                          
                                            @endif
                                    </p>
                                        
                                       <p>I understand that this service I am about to purchase is non refundable and I am about to purchase it of my own free will.</p>
                                    </p>
                                </div>
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

    @if($booking->test_kit == null || $booking->test_kit == "[null]")
         @if($booking->product != null)
            @if($booking->product->product_id == 15)
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Add test kit number</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/add/test_kit') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$booking->product->id}}">
                            @for($x =0; $x < $booking->product->quantity; $x++)
                                @if($booking->product->quantity > 1)
                                    <label><b>Test kit number {{$x + 1}}</b></label>
                                @else
                                    <label><b>Test kit number</b></label>
                                @endif
                                
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" name="test_kit{{$x}}" value="{{ old('test_kit'.$x) }}" required >
                                    <div class="input-group-append" data-toggle="modal" data-target="#barcodeModal">
                                         <span class="input-group-text">Scan barcode</span>
                                    </div>
                                </div>
                            @endfor 
                            
                            
                            <button type="submit" class="btn btn-outline-info"> submit</button>  
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        </div>
                        </div>

                    </div>
                </div>
            @endif
        @endif
    @endif

    <!-- Modal -->
    <div id="barcodeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
             <h4 class="modal-title">Scan your barcode</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>
        <div class="modal-body">
            <P>Plaese select a camera of your choice</p>
        <video id="preview"></video>

            <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
                </label>
                <label class="btn btn-primary">
                    <input type="radio" name="options" value="2" autocomplete="off" checked> Back Camera
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
        </div>

    </div>
    </div>
@endsection
@section('script')
    <script src="/assets/vendor/data-tables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/data-tables/dataTables.bootstrap4.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js" rel="nofollow"></script>
    <script type="text/javascript">
        var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
        scanner.addListener('scan',function(content){
            alert(content);
            //window.location.href=content;
        });

        Instascan.Camera.getCameras().then(function (cameras){
            if(cameras.length>0){
                
                $('[name="options"]').on('change',function(){
                   
                    if($(this).val()==1){
                        if(cameras[0]!=undefined){
                            scanner.start(cameras[0]);
                        }else{
                            alert('No Front camera found!');
                        }
                    }else if($(this).val()==2){
                       
                        if(cameras[1]!=undefined){
                            scanner.start(cameras[1]);
                        }else{
                            alert('No Back camera found!');
                        }
                    }
                });
            }else{
                console.error('No cameras found.');
                alert('No cameras found.');
            }
        }).catch(function(e){
            console.error(e);
            alert(e);
        });

    </script>
    
@endsection