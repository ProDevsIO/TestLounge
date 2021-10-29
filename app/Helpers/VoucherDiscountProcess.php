<?php

namespace App\Helpers;

use App\Models\VoucherPayment;
use App\Models\VoucherDiscount;
use App\Models\Transaction;
use App\Models\User;

class VoucherDiscountProcess
{
    public static function processTransaction($userid, $v_pay_id , $amount_credit , $cost_booking , $percentage)
    {
        $voucherpay = VoucherPayment::where('id', $v_pay_id)->first();

        if($voucherpay->currency != 'NG'){

       
            $v = VoucherDiscount::create([
                    'amount' => $amount_credit,
                    'v_pay_id' => $voucherpay->id,
                    'user_id' => $userid,
                    'cost_config' => $cost_booking,
                    'pecentage_config' => $percentage,
                    'currency' => 'USD'
            ]);

        }elseif($voucherpay->currency = 'NG'){

           $v = VoucherDiscount::create([
                'amount' => $amount_credit,
                'v_pay_id' => $voucherpay->id,
                'user_id' => $userid,
                'cost_config' => $cost_booking,
                'pecentage_config' => $percentage,
                'currency' => 'NG'
            ]);

        }
        
    }

}