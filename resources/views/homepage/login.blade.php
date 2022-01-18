@extends('layouts.login')

@section('content')
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="{{ url('/') }}" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="/images/logo.png" alt="" height="22">
                                            </span>
                                    </a>

                                    <a href="{{ url('/') }}" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="/images/logo.png" alt="" height="22">
                                            </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin
                                    panel.</p>
                            </div>

                            @include('errors.showerrors')
                            <form action="{{ url('/login') }}" method="post">
@csrf
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control" type="email" id="emailaddress" required
                                           value="{{ old('email') }}" name="email" placeholder="Enter your email">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-addon p-2 "
                                              style="border:1px solid #ced4da; border-radius:10px 0px 0px 10px;cursor: pointer;"
                                              onclick="myFunction()"> <i><img
                                                    src="https://img.icons8.com/ios-glyphs/20/000000/visible.png"/></i></span>
                                        <input type="password" class="form-control" name="password"
                                               id="exampleInputPassword1"
                                               placeholder="Enter Password" style="border-radius:0px 10px 10px 0px"
                                               required/>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>
                                <div class="text-center d-grid">
                                    <button class="btn btn-primary" type="submit"> Log In</button>
                                </div>
                            </form>


                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->


                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

@endsection
@section('script')
    <script>
        function myFunction() {
            var x = document.getElementById("exampleInputPassword1");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
