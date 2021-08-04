<?php

namespace App\Http\Controllers;

use App\Models\CountryColor;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function processStripe($price,$booking){
        \Stripe\Stripe::setApiKey(env('Stripe_Key','sk_test_51JHzEGI12ZmR225jgcGfjm25u1RsPopaeB4x2Z6E32SsCaTGQQMB0GAFbBdEaHZLLBHBYAvEsOZjhf1CkooC9bTR00rh2Iytpz'));

        header('Content-Type: application/json');
        $YOUR_DOMAIN = env('APP_URL', "https://uktraveltest.prodevs.io/");

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => [
                'card',
            ],
            'line_items' => [[
                'price' => $price,
                'quantity' => 1
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . 'booking/stripe/success?b='.encrypt_decrypt('encrypt',$booking->id),
            'cancel_url' => $YOUR_DOMAIN . 'booking/stripe/failed?b='.encrypt_decrypt('encrypt',$booking->id),
        ]);

        return $checkout_session->url;
    }
    public function processFL(array $request = [])
    {
        $ch = curl_init();
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . env('RAVE_SECRET_KEY',"FLWSECK_TEST-516babb36b12f7f60ae0a118dcc9482a-X");
        curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/payments");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        $server_output = json_decode($server_output);
        //dd($server_output);
        return $server_output->data->link;
    }

    function bank($country)
    {
        $ch = curl_init();
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . env('RAVE_SECRET_KEY', "FLWSECK_TEST-516babb36b12f7f60ae0a118dcc9482a-X");
        curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/banks/" .$country);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        $server_output = json_decode($server_output);

        return $server_output->data;
    }

    function account_name_($bank,$account_no)
    {
        $ch = curl_init();
        $request['account_number'] =$account_no;
        $request['account_bank'] =$bank;
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . env('RAVE_SECRET_KEY',"FLWSECK_TEST-516babb36b12f7f60ae0a118dcc9482a-X");
        curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/accounts/resolve");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        $server_output = json_decode($server_output);
        //dd($server_output);
        return $server_output;
    }

    function getFlutterwaveData($booking,$price,$transaction_ref){
        if ($booking->country_travelling_from_id == 81) {
            // naira to ghanian cedis
            $convert_amount = $price * 0.014;
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $convert_amount,
                "currency" => "GHS",
                "redirect_url" => env('APP_URL', "https://uktraveltest.prodevs.io/") . "payment/confirmation",
                "customer" => [
                    'email' => $booking->email,
                    'phonenumber' => $booking->phone_no,
                    'name' => $booking->first_name . " " . $booking->last_name
                ],
                "customizations" => [
                    "title" => "UK Covid Testing Booking"
                ]
            ];
        } elseif ($booking->country_travelling_from_id == 156) {
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $price,
                "currency" => "NGN",
                "redirect_url" => env('APP_URL', "https://uktraveltest.prodevs.io/") . "payment/confirmation",
                "customer" => [
                    'email' => $booking->email,
                    'phonenumber' => $booking->phone_no,
                    'name' => $booking->first_name . " " . $booking->last_name
                ],
                "customizations" => [
                    "title" => "UK Covid Testing Booking"
                ]
            ];
        } elseif ($booking->country_travelling_from_id == 210) {
            // naira to tanzanian cedis
            $convert_amount = $price * 5.56;
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $convert_amount,
                "currency" => "TZS",
                "redirect_url" => env('APP_URL', "https://uktraveltest.prodevs.io/") . "payment/confirmation",
                "customer" => [
                    'email' => $booking->email,
                    'phonenumber' => $booking->phone_no,
                    'name' => $booking->first_name . " " . $booking->last_name
                ],
                "customizations" => [
                    "title" => "UK Covid Testing Booking"
                ]
            ];
        } elseif ($booking->country_travelling_from_id == 110) {
            // naira to kenyan shillings
            $convert_amount = $price * 0.26;
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $convert_amount,
                "currency" => "KES",
                "redirect_url" => env('APP_URL', "https://uktraveltest.prodevs.io/") . "payment/confirmation",
                "customer" => [
                    'email' => $booking->email,
                    'phonenumber' => $booking->phone_no,
                    'name' => $booking->first_name . " " . $booking->last_name
                ],
                "customizations" => [
                    "title" => "UK Covid Testing Booking"
                ]
            ];
        } elseif ($booking->country_travelling_from_id == 197) {
            // naira to south african rand
            $convert_amount = $price * 0.036;
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $convert_amount,
                "currency" => "ZAR",
                "redirect_url" => env('APP_URL', "https://uktraveltest.prodevs.io/") . "payment/confirmation",
                "customer" => [
                    'email' => $booking->email,
                    'phonenumber' => $booking->phone_no,
                    'name' => $booking->first_name . " " . $booking->last_name
                ],
                "customizations" => [
                    "title" => "UK Covid Testing Booking"
                ]
            ];
        } else {
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $price,
                "currency" => "NGN",
                "redirect_url" => env('APP_URL', "https://uktraveltest.prodevs.io/") . "payment/confirmation",
                "customer" => [
                    'email' => $booking->email,
                    'phonenumber' => $booking->phone_no,
                    'name' => $booking->first_name . " " . $booking->last_name
                ],
                "customizations" => [
                    "title" => "UK Covid Testing Booking"
                ]
            ];
        }

        return $data;
    }

    function sendData($booking)
    {

        //ethnicity
        if ($booking->ethnicity == 0) {
            $ethnic = "white_other";
        } elseif ($booking->ethnicity == 1) {
            $ethnic = "other_mixed";
        } elseif ($booking->ethnicity == 2) {
            $ethnic = "other_mixed";
        } elseif ($booking->ethnicity == 3) {
            $ethnic = "black_other";
        } elseif ($booking->ethnicity == 4) {
            $ethnic = "Other_mixed";
        }

        //transportation means
        if ($booking->method_of_transportation == 1) {
            $transport = "Airline";
        } elseif ($booking->method_of_transportation == 2) {
            $transport = "Vessel";
        } elseif ($booking->method_of_transportation == 3) {
            $transport = "Train";
        } elseif ($booking->method_of_transportation == 4) {
            $transport = "Road Vehicle";
        } elseif ($booking->method_of_transportation == 5) {
            $transport = "Others";
        }

        $color_code = CountryColor::where('country_id',$booking->country_travelling_from_id)->first();

        $data_send["test_kit_properties"] = [
            'first_name' => $booking->first_name,
            'last_name' => $booking->last_name,
            'birth_date' => Carbon::parse($booking->dob)->format('Y-m-d'),
            'sex' => ($booking->sex == 1) ? "Male" : "Female",
            'ethnicity' => $ethnic,
            "email" => $booking->email,
            'vaccine_type' => ($booking->vaccination_type) ? $booking->vaccination_type : "n/a",
            "mobile" => $booking->phone_no,
            "arrival_in_uk" => Carbon::parse($booking->arrival_date)->toDateString(),
            "country_from" => $booking->travelingFrom->name,
            "nhs_number" => $booking->nhs_number,
            "departure_from_abroad_date" => Carbon::parse($booking->departure_date)->format('Y-m-d'),
            "flight_number" => $booking->transport_no,
            "passport" => $booking->document_id,
            'vaccination_status' => $booking->vaccination_status,
            "address_line_1" => $booking->isolation_address,
            "city" => $booking->isolation_town,
            "postcode" => $booking->isolation_postal_code,
            "country_type" => (optional($color_code->color)->name) ? optional($color_code->color)->name : "Amber",
            "countries_travelled" => ($booking->travelingFrom) ? optional($booking->travelingFrom)->name: "Nigeria"
        ];

        if ($booking->vaccination_type && $booking->vaccination_type != "n/a") {
            $data_send["test_kit_properties"]["vaccination_date"] = Carbon::parse($booking->vaccination_date)->toDateString();
        }

        $data_send["shipping_address_attributes"] =
            [
                "line_1" => $booking->isolation_address,
                "city" => $booking->isolation_town,
                "postcode" => $booking->isolation_postal_code
            ];

        $data_send['external_reference'] = "booking_".$booking->id;
        $data_send['product'] = optional(optional($booking->product)->product)->name;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://portal.ukhealthtesting.com/api/partner_orders");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query($data_send));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $data_response = json_decode($response);

        return $data_response->reference;
    }


}
