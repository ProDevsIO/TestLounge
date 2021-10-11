<div class="table-responsive">
                                @if($bookings->count() > 0)
                                    <table class="table table-hover table-custom" id="data_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Date/Time</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Mode of Payment</th>
                                            @if(auth()->user()->referal_code)
                                                <th scope="col">Earnings</th>
                                            @endif
                                            @if(auth()->user()->type == "1")
                                                <th scope="col">Vendor</th>
                                                <th scope="col">Referral</th>
                                                <th scope="col">Action</th>
                                            @endif
                                            @if(auth()->user()->vendor_id != "0")
                                                <th scope="col">Action</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bookings as $booking)
                                            <tr>
                                                <td>
                                                    {{ $booking->first_name }} {{ $booking->last_name }}
                                                </td>
                                                <td>{{ $booking->phone_no }}</td>
                                                <td>{{ $booking->email }}<br/>
                                                    @if(auth()->user()->type == "1")
                                                        <ul>
                                                            <li>{{ optional(optional($booking->product)->product)->name }}
                                                                ({{ optional($booking->product)->currency.number_format(optional($booking->product)->charged_amount,2)}}
                                                                ) 
                                                            </li>
                                                        </ul>
                                                        <br/>
                                                        @if($booking->booking_code)
                                                            Reference Code: {{ $booking->booking_code }}
                                                        @endif
                                                    @endif
                                                </td>

                                                <td> {{ $booking->created_at }} </td>
                                                <td>@if($booking->status == 0)
                                                        <span class="badge badge-warning">Not Paid</span>
                                                    @elseif($booking->status == 1)
                                                        <span class="badge badge-success">Paid</span>
                                                    @endif</td>
                                                <td>
                                                    @if($booking->mode_of_payment == 1)
                                                        Flutterwave
                                                    @elseif($booking->mode_of_payment == 2)
                                                        Stripe
                                                    @endif
                                                </td>
                                                @if(auth()->user()->referal_code)
                                                    <td> @php
                                                            if($booking->transaction){
                                                                echo "₦".number_format($booking->transaction->amount,2);
                                                            }elseif($booking->ptransaction){
                                                                echo "$".number_format($booking->ptransaction->amount,2);
                                                            }
                                                        @endphp</td>
                                                @endif
                                                @if(auth()->user()->type == "1")
                                                    <td>
                                                        {{ ($booking->vendor) ? $booking->vendor->name : "none" }}
                                                    </td>
                                                    <td>
                                                        {{ ($booking->user) ? $booking->user->first_name." ".$booking->user->last_name : "none" }}
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button id="btnGroupDrop1" type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                <a href="{{ url('/view/booking/'.$booking->id) }}"
                                                                   class="dropdown-item">View</a>
                                                                <a href="{{ url('/booking/delete/'.$booking->id) }}"
                                                                   class="dropdown-item">Delete</a>
                                                                @if($booking->status== 1)
                                                                    <a href="javascript:;" data-toggle="modal"
                                                                    data-target="#editEmail{{ $booking->id }}"
                                                                    class="dropdown-item">Edit Email</a>
                                                                    <a href="javascript:;"
                                                                    onclick="resendReceipt('{{ $booking->id }}')"
                                                                    class="dropdown-item">Resend Receipt</a>
                                                               
                                                                    @if($booking->user_id == null)
                                                                        <a class="dropdown-item" data-toggle="modal"
                                                                        href="#refmodal{{$booking->id}}">Add a
                                                                            referral</a>
                                                                    @endif
                                                                @endif
                                                                @if($booking->status== 0)
                                                                <a href="javascript:;" class="dropdown-item" target="_blank" data-toggle="modal" data-target="#bookingModal{{ $booking->id }}">Check for Payment</a>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <div class="modal fade" id="bookingModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Verify Payment</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <a href="{{ url('/booking/stripe/success?b='.encrypt_decrypt("encrypt",$booking->id)) }}" target="_blank" class="btn btn-danger">Stripe</a>
                                                                <a href="{{ url('/payment/confirmation?tx_ref='.$booking->transaction_ref) }}" target="_blank" class="btn btn-danger">Flutterwave</a>
                                                                <a href="{{ url('/payment/paystack/confirmation?trxref='.$booking->transaction_ref) }}" target="_blank" class="btn btn-danger">Paystack</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                    </td>
                                                @endif

                                                @if(auth()->user()->vendor_id != "0")
                                                    <td><a href="{{ url('/view/booking/'.$booking->id) }}"
                                                           class="btn btn-info">View</a>
                                                        <a href="{{ url('/send/booking/'.$booking->id) }}"
                                                           class="btn btn-info">Send to Logistics Company</a>
                                                    </td>
                                                @endif
                                            </tr>
                                            <!-- Modal -->
                                            <div id="refmodal{{$booking->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add a referral</h4>
                                                            <button type="button" class="close pull-left"
                                                                    data-dismiss="modal">&times;
                                                            </button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/add/referer/'.$booking->id) }}"
                                                                  method="post">
                                                                @csrf
                                                                <label for="">Referrers</label>
                                                                <select name="referal_code" class="form-control" id=""
                                                                        required>
                                                                    <option value="">Select a referer</option>
                                                                    @if(isset($refs))
                                                                        @foreach($refs as $ref)
                                                                            <option value="{{$ref->referal_code}}">{{$ref->first_name}} {{$ref->last_name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-sm btn-info">submit
                                                            </button>
                                                            </form>
                                                            <button type="button" class="btn btn-sm btn-info"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Modal -->
                                            <div class="modal fade" id="editEmail{{ $booking->id }}" tabindex="-1"
                                                 role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ url('edit/email') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $booking->id }}">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    Email</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="email" name="email"
                                                                       value="{{ $booking->email }}"
                                                                       class="form-control"/>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        </tbody>
                                    </table>
                                @else
                                    <div style="padding: 15px">
                                        <div class="alert alert-danger">
                                            @if(auth()->user()->referal_code)
                                                No Booking has been created with your referral link
                                            @else
                                                No Booking has been created
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>