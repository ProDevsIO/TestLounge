@extends('layouts.home')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .iti {
            width: 100%;
        }

        .show_required {
            color: red;
        }

        .choices__input {
            width: 100%;
            margin-bottom: 0px;
        }

        @media screen and (max-width: 800px) {
            .bs-stepper-header {
                display: block;
                align-items: center;
            }
        }

        #descript {
            margin-top: 20px;
            width: 90%;
        }


        .radio-group {
            position: relative;
            margin-bottom: 25px
        }

        .radio {
            display: inline-block;
            height: 64px;
            border-radius: 0;
            background: #eee;
            box-sizing: border-box;
            border: 1px solid lightgrey;
            cursor: pointer;
            margin: 8px 25px 8px 0px
        }

        .radio:hover {
            box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.2)
        }

        .radio.selected {
            box-shadow: 0px 0px 0px 4px rgba(0, 0, 0, 0.4)
        }

        @media screen and (max-width: 600px) {
            .radio {
                width: 100%
            }
        }
    </style>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.css"
          integrity="sha512-DJ1SGx61zfspL2OycyUiXuLtxNqA3GxsXNinUX3AnvnwxbZ+YQxBARtX8G/zHvWRG9aFZz+C7HxcWMB0+heo3w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')

    <div class="main-container">
        <section class="contact-photo">


            <div class="container">
                <div class="row">

                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
                        <form action="" method="post">
                            @csrf
                            <div class="card-body">
                                <h1>To complete your payment
                                </h1>
                                @include('errors.showerrors')
                                <p>Name: {{ $booking->first_name }} {{ $booking->last_name }}</p>
                                <p>Email: {{ $booking->email }}</p>
                                <p>Phone: {{ $booking->phone_no }}</p>
                                <input type="hidden" name="payment_method" value="flutterwave" id="payment_method"/>
                                {{--<div class="col-md-12">--}}
                                    {{--<label>Choose Payment Method: <span--}}
                                                {{--class="show_required"> *</span></label>--}}
                                    {{--<div class="radio-group">--}}
                                        {{----}}
                                        {{--<div class='radio' data-value="stripe" style="margin-top: 10px"><img--}}
                                                    {{--src="{{ url('/img/stripe.png') }}"--}}
                                                    {{--height="60px"></div>--}}
                                        {{--<div class='radio' data-value="flutterwave" style="margin-top: 10px"><img--}}
                                                    {{--src="{{ url('/img/Flutterwave.png') }}"--}}
                                                    {{--height="60px"></div>--}}
                                        {{--<br>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <input type="submit" style="max-width: 200px;" value="Proceed to Payment" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div><!--end of row-->



            <!--end of container-->
            </div>
        </section>
    </div>

@endsection

@section('script')
    <script>

        $('.radio-group .radio').click(function () {
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
            var payment_method = $(this).data();
            $("#payment_method").val(payment_method.value);
        });
    </script>


@endsection