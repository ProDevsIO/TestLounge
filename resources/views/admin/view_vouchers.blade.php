@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        #generate_button:hover{
            background-color:white;
            color:black !important;
        }
        
        video {
        max-width: 100%;
        height: auto;
        }

       
        /* .dataTables_length{
            display:flex;
        }
        .dataTables_filter{
            float:right;
            margin:0;
            padding:0;
        } */
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
        @include('errors.showerrors')
            <div class="row">

                <?php $j =1;?>
                @foreach($products as $product)
                 <div class="col-xl-4 col-sm-4">
                        <div class="card mb-4 bg-purple" title="Generate voucher">
                            <div class="card-body">
                                <div class="media d-flex align-items-center ">
                                    <div class="mr-4 rounded-circle bg-white sr-icon-box text-purple">
                                        <i class="vl_book"></i>
                                    </div>
                                    <div class="media-body text-light" title="Generate voucher">
                                        <h6 class="text-uppercase mb-0 weight500">{{$product->name}}</h6>
                                        <span>Quota: 
                                            @if($product->voucherCount)
                                                @if(auth()->user()->type == 1)

                                                    <?php $pcount = 0;
                                                        foreach($product->voucherCount as $count){
                                                            
                                                            $pcount = $pcount + $count->quantity;
                                                        }
                                                    ?>
                                                    {{$pcount}}
                                                @else
                                                    {{$product->voucherCount->quantity}}
                                                @endif
                                                    
                                            @else  
                                              0
                                            @endif</span>
                                            
                                           
                                    </div>
                                    
                                </div>
                                <br>

                                @if($product->voucherCount && auth()->user()->type == 2)
                                    @if($product->voucherCount->quantity > 0)
                                        <button class="btn btn-outline-dark text-white btn-block" id="generate_button" style="color:white; border-color:white;" data-toggle="modal"
                                                                                href="#refmodal{{$product->id}}">generate voucher</button>
                                        <!-- <button class="btn btn-outline-dark text-white btn-block" id="generate_button" style="color:white; border-color:white;" data-toggle="modal"
                                                                                href="#assign{{$product->id}}">Assign to sub agent</button> -->
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                        <!-- Modal -->
                                        @if(auth()->user()->type ==2)
                                             <div id="refmodal{{$product->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Assign voucher code to Client</h4>
                                                            <button type="button" class="close pull-left"
                                                                    data-dismiss="modal">&times;
                                                            </button>

                                                        </div>
                                                        <div class="modal-body">
                                                                    <div class="alert alert-warning">
                                                                        <p><span class="badge badge-danger">Notice!</span> Once this code is generated, it will be assigned to this email address and email will be sent out with the booking link for the voucher, This simply means that the code generated can only be used by the assigned email for booking. </p>
                                                                    </div>
                                                            
                                                            <form action="{{ url('/voucher/email/' . $product->id) }}" method="post">
                                                                @csrf    
                                                                <label for=""> Client Email</label>
                                                                    <input type="email" name="email" id="email_{{$j}}"class="form-control" required>
                                                                    <br>
                                                                    <label for=""> Please select a quantity</label>
                                                                    <select name="quantity" id="quantity_{{$j}}" class="form-control" required @if($product->id == 15) onchange="generateKitField('{{$product->id}}', '{{$j}}')" @endif>
                                                                        <option value=""> Select a quantity</option>
                                                                    @if($product->voucherCount)
                                                                        @for($i=1; $i <= $product->voucherCount->quantity; $i++)
                                                                            <option value="{{$i}}">{{$i}}</option>
                                                                        @endfor
                                                                    @endif
                                                                   
                                                                    </select>
                                                                    <br>
                                                                    @if($product->id == 15)
                                                                        <div class="div_kit{{$j}}">

                                                                        </div>

                                                                    @endif
                                                        
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-sm bg-purple text-white">submit</button>
                                                            </form>
                                                            <button type="button" class="btn btn-sm bg-purple text-white"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endif
                                      <?php $j++; ?>         
                @endforeach
                     <div class="col-xl-12 p-0">
                            <div class="card card-shadow mb-4 ">
                                <div class="card-header border-0">
                                    <div class="custom-title-wrap border-0 position-relative pb-2">
                                        <div class="custom-title">Vouchers</div>
                                    </div>
                                </div>
                                <div class="alert alert-info"> Hint: Complete customer booking by clicking on their voucher number below once generated</div>
                                <div class="card-body p-0">
                                  
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom" id="data_table">
                                            <thead>
                                            <tr>
                                                @if(auth()->user()->type == 1)
                                                <th> Agent</th>
                                                @endif
                                                <th> Assigned</th>
                                                <th scope="col">Voucher Number</th>
                                                <th scope="col" style="padding-left:70px; padding-right:70px">Test package</th>
                                                <!-- <th scope="col">Amount</th> -->
                                                <th scope="col">Quantity</th>
                                                
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                               
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                       
                                            @foreach($vouchers as $voucher)
                                        
                                                    <tr>
                                                       
                                                        @if(auth()->user()->type == 1)
                                                            @if(!empty($voucher->user))
                                                            <td>{{ $voucher->user->first_name }} {{ $voucher->user->last_name }}</td>
                                                            @else
                                                            <td> <span class ="badge badge-danger"> Agent NULL</span></td>
                                                            @endif
                                                        @endif
                                                        @if($voucher->email != null)
                                                            <td>{{ $voucher->email }}</td>
                                                         @else
                                                            <td> <span class ="badge badge-warning text-white"> UNASSIGNED</span></td>
                                                        @endif
                                                        <td><a href="/booking/voucher/{{ $voucher->voucher }}">{{ $voucher->voucher }}</a></td>

                                                        <td>{{optional(optional(optional($voucher)->voucherCount)->product)->name}}</td>
                                                        
                            
                                                        
                                                        <td>@if($voucher->quantity == 0)
                                                            Quota has been used up
                                                            @else
                                                            {{ $voucher->quantity }}
                                                            @endif
                                                        </td>
                                                        
                                                        @if($voucher->status == 0)
                                                        <td><span class ="badge badge-warning">Pending </span></td>
                                                        @else
                                                        <td> <span class ="badge badge-success"> Used</span></td>
                                                        @endif
                                                        <td>{{ $voucher->created_at }}</td>
                                                        <!-- <td>
                                                            <div class="btn-group" role="group">
                                                                <button id="btnGroupDrop1" type="button"
                                                                        class="btn btn-primary dropdown-toggle btn-sm"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                   
                                                                    @if($voucher->email == null)
                                                                   
                                                                        <a class="dropdown-item" data-toggle="modal"
                                                                        href="#refmodal{{$voucher->id}}">Send code via email</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td> -->
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
    </div>

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

    @foreach($products as $product)
                                                    <div class="modal fade" id="assign{{ $product->id }}"
                                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{ url('/agent/assign/voucher/'.$product->id) }}"
                                                                      method="post">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Assign voucher to sub agent</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <label class="text-muted">Agents</label>
                                                                        <select name="agent" class="form-control" id="" required>
                                                                           @foreach($sub_agents as $subagent)
                                                                                <option value="{{$subagent->id}}"> {{ $subagent->first_name }} {{ $subagent->last_name }}</option>
                                                                           @endforeach
                                                                        </select>

                                                                        <label for=""> Please select a quantity</label>
                                                                        <select name="quantity" class="form-control" required >
                                                                            <option value=""> Select a quantity</option>
                                                                            @if($product->voucherCount)
                                                                                @for($i=1; $i <= $product->voucherCount->quantity; $i++)
                                                                                    <option value="{{$i}}">{{$i}}</option>
                                                                                @endfor
                                                                            @endif
                                                                    
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Assign
                                                                        </button>
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close
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
                            scanner.stop();
                        }
                    }else if($(this).val()==2){
                       
                        if(cameras[1]!=undefined){
                            scanner.start(cameras[1]);
                        }else{
                            alert('No Back camera found!');
                            scanner.stop();
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

        function sendGenerateData(id, count) {
            var e = 'email_' + count;
            var q = 'quantity_' + count;
            var d = confirm("Are you sure you want to generate a voucher for this client?");
            var email = document.getElementById(e).value;
            var quantity = document.getElementById(q).value;
            // console.log(email, quantity);
            if (d) {

                // window.location = '/voucher/email/'+ id + '/' + email + '/' +quantity;
            }
        }

       
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
    </script>

    @if(auth()->user()->enable_barcode == 1)
    <script>
       function generateKitField(id, count) {
            var q = 'quantity_' + count;
            var id = id;
            var kit_n = ".div_kit" + count;
            var quantity = document.getElementById(q).value;
            // console.log(email, quantity);
            console.log(q, id, quantity, count);
            if (id == 15) {
                var $card = $(kit_n);
            
            $card.empty(); // remove old options
                for(i = 0 ; i< quantity; i++){
                    $card.append($("<label>Test kit number</label><br>"))
                    $card.append($("<div class='input-group mb-3'><input type='text' class='form-control' placeholder='Type test kit number' name='test_kit"+ i + "' required><div class='input-group-append' data-toggle='modal' data-target='#barcodeModal'><span class='input-group-text'>Scan barcode</span></div></div>")); 
                
                }
            
            }

        }


    </script>
    @elseif(auth()->user()->enable_barcode == 0)
    <script>
       function generateKitField(id, count) {
            var q = 'quantity_' + count;
            var id = id;
            var kit_n = ".div_kit" + count;
            var quantity = document.getElementById(q).value;
            // console.log(email, quantity);
            console.log(q, id, quantity, count);
            if (id == 15) {
                var $card = $(kit_n);
            
            $card.empty(); // remove old options
                for(i = 0 ; i< quantity; i++){
                    $card.append($("<label>Test kit number</label><br>"))
                    $card.append($("<input type='text' class='form-control' placeholder='Type test kit number' name='test_kit"+ i + "' required>")); 
                
                }
            
            }

        }


    </script>
    @endif
@endsection