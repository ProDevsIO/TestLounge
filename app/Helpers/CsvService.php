<?php

namespace App\Helpers;


class CsvService
{
    public function processRoyalMail($bookings, $product_id)
    {
        $fileName = 'RoyalMailExport.csv';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Full Name','Address','Address 2', 'Address 3' ,'Post Town', 'Country', 'Post Code', 'Phone', 'Email', 'Products', 'Home Address', "Isolation Address", "Arrival Date", "Order ref", "Service code", "SMS", "weight", "Safe place", "Email notification", "Parcel Format", "Special instructions");

        $callback = function () use ($bookings, $columns, $product_id) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, $columns);


            foreach ($bookings as $booking) {
                
                $p = [];
                foreach ($booking->products as $product) {

                    if($product->id == $product_id)
                    {
                        $p[] = $product->name;
               

                        $row['Name'] = $booking->first_name . " " . $booking->last_name;
                        $row['address'] = $booking->isolation_address;
                        $row['address2'] = $booking->isolation_address2;
                        $row['post_town'] = $booking->isolation_town;
                        $row['country'] = "United Kingdom";
                        $row['post_code'] = $booking->isolation_postal_code;
                        $row['PhoneNo'] = $booking->phone_no;
                        $row['Email'] = $booking->email;
                        $row['order_ref'] = $booking->id;
                        $row['Service code'] = "TPN24";
                        $row['sms'] = "Y";
                        $row['weight'] = "0.999";
                        $row['safe_place'] = "Leave with neighbor";
                        $row['notify'] = "Y";
                        $row['parcel'] = "parcel";
                        $row['instruct'] = "New";
                    
                        fputcsv($file, array(   
                                                $row['Name'], 
                                                $row['address'],
                                                " ", 
                                                $row['address2'],
                                                $row['post_town'],
                                                $row['country'],
                                                $row['post_code'], 
                                                $row['PhoneNo'],
                                                $row['Email'],
                                                $row['order_ref'],
                                                $row['Service code'],
                                                $row['sms'],
                                                $row['weight'],
                                                $row['safe_place'],
                                                $row['notify'],
                                                $row['parcel'],
                                                $row['instruct']
                                            )
                                    );
                    }
                   
                }
            }

            fclose($file);
        };

       $data = [
           "callback" => $callback ,
           "headers" => $headers,
          
       ];
        
       return $data;
     
    }

    public function processLabMail($bookings, $product_id)
    {
        $fileName = 'LabMailExport.csv';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Patient Forename', 'Patient Surname', 'Sex', 'Patient date of Birth', 'Patient Ethinicity', "Contact Number", "Email", "Patient Address", "Patient Postcode", "Passport Number", "Locator reference","Test Type");

        $callback = function () use ($bookings, $columns, $product_id) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, $columns);


            foreach ($bookings as $booking) {
 
                $p = [];
                foreach ($booking->products as $product) {

                    $p[] = $product->name;
               

                    if ($booking->sex == 1) {
                        $sex = "Male";
                    } else{
                        $sex = "Female";
                    }
                    
                    if($product->id == $product_id)
                    {
                        $row['fname'] = $booking->first_name;
                        $row['lname'] = $booking->last_name;
                        $row['address'] = $booking->isolation_address;
                        $row['sex'] = $sex;
                        $row['dob'] =  $booking->dob;

                        if ($booking->ethnicity == "1") {
                            $row['Ethnicity'] = "White";
                        } elseif ($booking->ethnicity == "2") {
                            $row['Ethnicity'] = "Mixed/Multiple Ethnic groups";
                        } elseif ($booking->ethnicity == "3") {
                            $row['Ethnicity'] = "Asian / Asian British";
                        } elseif ($booking->ethnicity == "4") {
                            $row['Ethnicity'] = "Black / African / Caribbean / Black British";
                        } elseif ($booking->ethnicity == "5") {
                            $row['Ethnicity'] = "Other Ethnic Group";
                        } 
                        $row['post_code'] = $booking->isolation_postal_code;
                        $row['PhoneNo'] = $booking->phone_no;
                        $row['Email'] = $booking->email;
                        $row['ref'] = $booking->booking_code;
                        $row['test_type'] = implode(',', $p);
                    
                    
                        fputcsv($file, array(   
                                            $row['fname'],
                                            $row['lname'],
                                            $row['sex'],
                                            $row['dob'],
                                            $row['Ethnicity'], 
                                            $row['PhoneNo'],
                                            $row['Email'],
                                            $row['address'],
                                            $row['post_code'],
                                            "12345678",
                                            $row['ref'],
                                            $row['test_type']
                                        )
                                );
                    }
                }
            }

            fclose($file);
        };

       $data = [
           "callback" => $callback ,
           "headers" => $headers
       ];
        
       return $data;
     
    }


}


