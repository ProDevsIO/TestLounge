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
                                <div class="custom-title">Add Bank</div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            @include('errors.showerrors')
                            <form action="{{ url('/add/bank') }}" method="post">
                                @csrf
                                <label>Bank</label>
                                <select name="account_bank" class="form-control" required>
                                    <option value="">Select a Bank</option>
                                    @foreach($banks as $bank)
                                        <option value="{{ $bank->code }}" @if(auth()->user()->account_bank == $bank->code)
                                            selected
                                            @endif>{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                                <label>Account No</label>
                                <input type="number" name="account_no" class="form-control"
                                       value="{{ auth()->user()->account_no }}" required/>
                                <br/>
                                <input type="submit" value="Add Bank Account" class="btn btn-primary"/>
                            </form>
                        </div>
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
        $(document).ready(function () {
            $('#data_table').DataTable({
                "order": []
            });
        });

        function makeAdmin(id) {
            var d = confirm("Are you sure, you want to make this user an Admin?");

            if (d) {
                window.location = "/admin/make/".id;
            }
        }

        function makeAgent(id) {
            var d = confirm("Are you sure, you want to make this user an Agent?");

            if (d) {
                window.location = "/agent/make/".id;
            }
        }
    </script>
@endsection