<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterTest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'barcode' => 'required_with:barcode_confirm|same:barcode_confirm',
            'barcode_confirm' => 'min:6',
            'date_of_sampling' => 'required',
            "result_observed" => "required",
            "type_of_test" => "required",
            "first_name" => "required",
            "last_name" => "required",
            "address" => "required",
            "flat_number" => "required",
            "postal_code" => "required",
            "city" => "required",
            "phone" => "required",
            "email" => "required_with:confirm_email|same:confirm_email",
            "confirm_email" => "required",
            "gender" => "required",
            "ethnicity" => "required",
            "dob" => "required",
            "passport_number" => "required",
            "symptoms" => "required",
            "travel_type" => "required",
            "flightNumber" => "required",
            "arrivalDate" => "2022/01/07 21:01",
            "countryVisited" => "hshshs,sdhjsd",
            "vaccination" => "1",
            "termsConsent" => "1",
            "_token" => "5TlmfUfXWWA0ZG6n8BF4u1xWEzuaoIng76Q7jGwr",
            "picture" => "required"
        ];
    }
}
