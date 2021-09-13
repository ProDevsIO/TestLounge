<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Receipt</title>

    <style>
        /* -------------------------------------
    GLOBAL
    A very basic CSS reset
------------------------------------- */
        * {
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            box-sizing: border-box;
            font-size: 14px;
        }

        img {
            max-width: 100%;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6;
        }

        /* Let's make sure all tables have defaults */
        table td {
            vertical-align: top;
        }

        /* -------------------------------------
            BODY & CONTAINER
        ------------------------------------- */
        body {
            background-color: #f6f6f6;
        }

        .body-wrap {
            background-color: #f6f6f6;
            width: 100%;
        }

        .container {
            display: block !important;
            max-width: 600px !important;
            margin: 0 auto !important;
            /* makes it centered */
            clear: both !important;
        }

        .content {
            max-width: 600px;
            margin: 0 auto;
            display: block;
            padding: 20px;
        }

        /* -------------------------------------
            HEADER, FOOTER, MAIN
        ------------------------------------- */
        .main {
            background: #fff;
            border: 1px solid #e9e9e9;
            border-radius: 3px;
        }

        .content-wrap {
            padding: 20px;
        }

        .content-block {
            padding: 0 0 20px;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
        }

        .footer {
            width: 100%;
            clear: both;
            color: #999;
            padding: 20px;
        }

        .footer a {
            color: #999;
        }

        .footer p, .footer a, .footer unsubscribe, .footer td {
            font-size: 12px;
        }

        /* -------------------------------------
            TYPOGRAPHY
        ------------------------------------- */
        h1, h2, h3 {
            font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            color: #000;
            margin: 40px 0 0;
            line-height: 1.2;
            font-weight: 400;
        }

        h1 {
            font-size: 32px;
            font-weight: 500;
        }

        h2 {
            font-size: 24px;
        }

        h3 {
            font-size: 18px;
        }

        h4 {
            font-size: 14px;
            font-weight: 600;
        }

        p, ul, ol {
            margin-bottom: 10px;
            font-weight: normal;
        }

        p li, ul li, ol li {
            margin-left: 5px;
            list-style-position: inside;
        }

        /* -------------------------------------
            LINKS & BUTTONS
        ------------------------------------- */
        a {
            color: #1ab394;
            text-decoration: underline;
        }

        .btn-primary {
            text-decoration: none;
            color: #FFF;
            background-color: #1ab394;
            border: solid #1ab394;
            border-width: 5px 10px;
            line-height: 2;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            text-transform: capitalize;
        }

        /* -------------------------------------
            OTHER STYLES THAT MIGHT BE USEFUL
        ------------------------------------- */
        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .aligncenter {
            text-align: center;
        }

        .alignright {
            text-align: right;
        }

        .alignleft {
            text-align: left;
        }

        .clear {
            clear: both;
        }

        /* -------------------------------------
            ALERTS
            Change the class depending on warning email, good email or bad email
        ------------------------------------- */
        .alert {
            font-size: 16px;
            color: #fff;
            font-weight: 500;
            padding: 20px;
            text-align: center;
            border-radius: 3px 3px 0 0;
        }

        .alert a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
        }

        .alert.alert-warning {
            background: #f8ac59;
        }

        .alert.alert-bad {
            background: #ed5565;
        }

        .alert.alert-good {
            background: #1ab394;
        }

        /* -------------------------------------
            INVOICE
            Styles for the billing table
        ------------------------------------- */
        .invoice {
            margin: 40px auto;
            text-align: left;
            width: 80%;
        }

        .invoice td {
            padding: 5px 0;
        }

        .invoice .invoice-items {
            width: 100%;
        }

        .invoice .invoice-items td {
            border-top: #eee 1px solid;
        }

        .invoice .invoice-items .total td {
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            font-weight: 700;
        }

        /* -------------------------------------
            RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 640px) {
            h1, h2, h3, h4 {
                font-weight: 600 !important;
                margin: 20px 0 5px !important;
            }

            h1 {
                font-size: 22px !important;
            }

            h2 {
                font-size: 18px !important;
            }

            h3 {
                font-size: 16px !important;
            }

            .container {
                width: 100% !important;
            }

            .content, .content-wrap {
                padding: 10px !important;
            }

            .invoice {
                width: 100% !important;
            }
        }
    </style>

</head>

<body style="background: #e1e1e1;font-family:Arial, Helvetica, sans-serif; font-size:1em;">

<table class="body-wrap">
    <tbody>
    <tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td class="content-wrap aligncenter">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr>
                                    <td class="content-block">
                                        <h2>Thanks for your booking</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <p style="text-align: left;line-height: 25px">
                                            Hi {{ $booking->first_name }} {{ $booking->last_name }}<br/>
                                            Thank you for choosing to book with us. <br/>
                                            Booking Reference: 
                                            <?php foreach($code as $decode){
                                                echo $decode .",";
                                                 }
                                                 ?>
                                          
                                            
                                            <br/>
                                            Test Provider: {{ $booking_product->vendor->name }}
                                            <br/>
                                            Please take a note of the above as you will require these to complete your passenger locator form
                                            .<br/>
                                            <a
                                               href="https://provide-journey-contact-details.homeoffice.gov.uk/passengerLocatorFormUserAccountHolderQuestion"
                                               target="_blank">Click here </a>to fill your passenger location form.
                                            <br/>
                                            We strongly advise that you complete your form before going to the airport.

                                            You may be required to show this email at the airport.<br/>

                                            For more information on test requirements kindly <a
                                                    href="https://www.gov.uk/guidance/coronavirus-covid-19-getting-tested">click here</a>
                                            <br/>
                                        </p>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <table class="invoice">
                                            <tbody>
                                            <tr>
                                                <td>{{ $booking->first_name }} {{ $booking->last_name }} <br>Invoice
                                                    #{{ str_pad($booking->id,5,"0",STR_PAD_LEFT) }}
                                                    <br>{{ Carbon\Carbon::parse($booking->created_at)->toDateString() }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            <td>{{ $product->name }} 1</td>
                                                            <td class="alignright">
                                                                {{ $booking_product->currency }} {{ number_format($booking_product->charged_amount,2) }}</td>
                                                        </tr>

                                                        <tr class="total">
                                                            <td class="alignright" width="80%">Total</td>
                                                            <td class="alignright">
                                                                {{ $booking_product->currency }} {{ number_format($booking_product->charged_amount,2) }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;line-height: 25px;">
                                        Email: {{ $booking->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;line-height: 25px;">
                                        Phone Number: {{ $booking->phone_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;line-height: 25px;">
                                        Arrival Flight to the UK: {{ $booking->transport_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;line-height: 25px;">
                                        Arrival Date to UK: {{ $booking->arrival_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;line-height: 25px;">
                                        Booking Reference: {{ $booking->transaction_ref }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;line-height: 25px;">
                                        Address in the UK: {{ $booking->isolation_address }}
                                        ,{{ $booking->isolation_town }},{{ $booking->isolation_postal_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block" style="text-align: left;line-height: 25px;">
                                        Vendor: {{ $booking_product->vendor->name }}
                                        . {{ $booking_product->vendor->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block" style="text-align: left;line-height: 25px;">
                                        Now that you have made your booking, you can read more about the next steps <a
                                                href="{{ url(env("APP_URL")."next_steps") }}">here</a>

                                        TravelTestGlobal
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="footer">
                    <table width="100%">
                        <tbody>
                        <tr>
                            <td class="aligncenter content-block">Questions? Email <a
                                        href="mailto:">{{ $booking_product->vendor->email }}</a></td>
                        </tr>
                        <tr>for more information and guidelines,click <a
                                    href="https://www.gov.uk/guidance/coronavirus-covid-19-getting-tested">Here</a></tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </td>
        <td></td>
    </tr>
    </tbody>
</table>
</body>
</html>