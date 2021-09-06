@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')


    <div class="content-wrapper">
        <div class="container-fluid">
            <!--employee data table-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap border-0 position-relative pb-2">
                                <div class="custom-title">Add/Update Bank
                                    <img src="/img/loader.gif" class="pull-right loader" style="height: 40px;display:none;"/></div>

                            </div>
                        </div>
                        <div class="card-body p-3">
                           
                            @include('errors.showerrors')
                            <form action="{{ url('/add/bank') }}" method="post">
                                @csrf

                                <label>Country</label>
                                <select name="country" class="form-control country_select" required
                                        onchange="updateBank()">
                                    <option value="">Select your Country</option>
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $key }}" @if(auth()->user()->country == $key)
                                        selected
                                                @endif>{{ $country }}</option>
                                    @endforeach
                                </select>
                                <textarea style="display: none;" id="bank_array" name="bank_array"></textarea>

                                <label>Bank</label>
                                <select name="account_bank" class="form-control account_bank" onselect="choosebank()" required>
                                    <option value="">Select a Bank</option>
                                </select>
                                <label>Account No</label>
                                <input type="number" name="account_no" class="form-control account_no" onkeyup="account_name_details()"
                                        required/>
                                <label>Account Name</label>
                                <input type="text" name="account_name" class="form-control" id="account_name"
                                        readonly/>
                                        <label>Password <span class="text-danger">*</span> </label>
                                <input type="password" name="password" class="form-control"  required><br>
                                <input type="submit" value="Add Bank Account" class="btn btn-primary"/>
                               
                            </form>
                        </div>

                        @if(auth()->user()->account_no)
                            <div class="card-body p-3">
                                <h5>Current Bank Details</h5>
                                <ul>
                                    <li>Country: {{ auth()->user()->country }}</li>
                                    <li>Bank: {{ auth()->user()->bank }}</li>
                                    <li>Account No: {{ auth()->user()->account_no }}</li>
                                    <li>Account Name: {{ auth()->user()->account_name }}</li>
                                </ul>
                            </div>
                        @endif
                    </div>
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
    <script>
    @if(auth()->user()->country)
        updateBank();
    @endif
            function updateBank() {
                var country = $(".country_select").val();
                    $(".loader").show();
                $.get('/country_bank/' + country, function (data) {
                    $("#bank_array").val(JSON.stringify(data));
                    var $el = $(".account_bank");
                    $el.empty(); // remove old options
                    $el.append($("<option value=''>Select your Bank</option>"));

                    $.each(data, function (key, value) {
                        $el.append($("<option></option>")
                            .attr("value", value.code).text(value.name));
                    });
                    $(".loader").hide();

                });

            }

            function account_name_details() {
                var account_bank = $(".account_bank").val();
                var account_no = $(".account_no").val();

                $(".loader").show();
                $.get('/account/name/' + account_bank +"/" + account_no, function (data) {
                    $("#account_name").val(data);
                    $(".loader").hide();
                });

            }
        </script>
    @endsection