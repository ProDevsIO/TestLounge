@extends('layouts.home')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <style>
        .iti {
            width: 100%;
        }

        .show_required {
            color: red;
        }
    </style>
@endsection
@section('content')

    <div class="main-container">

        <header class="title" style="max-height: 200px !important;">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/hero14.jpg">
            </div>
            <div class="container align-bottom">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="text-white">You’ve booked your test, now what’s next?</h1>
                    </div>
                </div><!--end of row-->
            </div><!--end of container-->
        </header>

        <section class="feature-selector">
            <div class="container">

            </div>

            <div class="container">
                <ul class="selector-content">
                    <li class="clearfix active">

                        <div class="row">
                            <div class="col-sm-12">


                                <h3>Before Travelling</h3><br/>
                                <ul>
                                    <ol> 1. It is important that you have access to your email and check your mailbox
                                        for information on your booking.
                                    </ol>
                                    <ol> 2. You will get an email with your receipt and a booking number or code which
                                        you need to make a note of. This number/ code is needed for your passenger
                                        locator form.
                                    </ol>
                                    <ol> 3. You might also need to show your payment receipt to the airline at the
                                        airport, so make sure you can access your email.
                                    </ol>
                                    <ol> 4. You need to fill out a passenger locator form before you travel to the UK
                                        even if you are only on transit through the UK. This can be done any time in the
                                        48hours before your arrival in the UK.
                                    </ol>
                                    <ol> 5. To fill the passenger locator, form out, you need:<br/>
                                        <div style="margin-left: 30px;">
                                        Your test booking reference/code would be emailed to you after your
                                                pay for
                                                your test<br/>

                                             Your passport details<br/>
                                           Your travel details
                                        </div>
                                    </ol>
                                    <ol> 6.  <a href="https://provide-journey-contact-details.homeoffice.gov.uk/passengerLocatorFormUserAccountHolderQuestion" target="_blank">Click here</a> to fill out your passenger locator form

                                    </ol>
                                </ul>
                                <br/>
                                <h3> On Arrival in The UK</h3><br/>
                                <ul>

                                        <ol>   7. When you get to the UK, you should get your test kit(s) sent to the address you gave
                                when you paid for your test.</ol>
                                        <ol>   8. It is important to note that your arrival date to the UK is Day 0.</ol>
                                        <ol>   9. When in the UK, you are required to take the tests on the appropriate days, day 2, 5
                                or 8 depending on the tests you bought.</ol>
                                        <ol>  10. The tests kit(s) posted to you would have the instructions needed to carry out your
                                test.</ol>
                                    <ol>  11. You can watch a video of how to take a self-swab test by <a href="https://www.gov.uk/government/publications/covid-19-guidance-for-taking-swab-samples/how-to-use-the-self-swabbing-kit-for-a-combined-throat-and-nose-swab-video" target="_blank">clicking here</a>
                                </ol>
                                        <ol>  12. When you have done your test, please follow the instructions on the test kit package
                                to know how to post the kit to the appropriate address. You should have received a
                                self-addressed envelope with the kit, so you don’t have to write the address, you only
                                need to put your test in the envelop and post it.</ol>
                                    <ol>  13. To find the nearest priority post box or post office to you, <a href="https://www.royalmail.com/services-near-you#/" target="_blank">click the link</a> and add
                                your postcode in.
                                </ol>
                                </ul>
                                </p>
                            </div>


                        </div><!--end of row-->
                    </li><!--end of individual feature content-->


                </ul>
            </div>
        </section>


    </div>

@endsection

