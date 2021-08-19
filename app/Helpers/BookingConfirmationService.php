<?php

namespace App\Helpers;

use App\Models\Booking;
use App\Models\PoundTransaction;
use App\Models\Transaction;
use App\Models\User;


class BookingConfirmationService
{

    public static function processPoundTransaction(User $user , $booking_id , $amount_credit , $cost_booking , $percentage)
    {

        PoundTransaction::create([
            'amount' => $amount_credit,
            'booking_id' => $booking_id,
            'user_id' => $user->id,
            'cost_config' => $cost_booking,
            'pecentage_config' => $percentage,
            'type' => "1"
        ]);


        $transactions =  PoundTransaction::where('type', "1")->where('user_id', $user->id)->sum('amount');

        $total_amount = $user->pounds_wallet_balance + $amount_credit;

        User::where('id', $user->id)->update([
            'pounds_wallet_balance' => $total_amount,
            'total_credit_pounds' => $transactions
        ]);
    }

    public static function processNairaTransaction(User $user , $booking_id , $amount_credit , $cost_booking , $percentage)
    {
        Transaction::create([
            'amount' => $amount_credit,
            'booking_id' => $booking_id,
            'user_id' => $user->id,
            'cost_config' => $cost_booking,
            'pecentage_config' => $percentage,
            'type' => "1"
        ]);


        $transactions = Transaction::where('type', "1")->where('user_id', $user->id)->sum('amount');

        $total_amount = $user->wallet_balance + $amount_credit;

        User::where('id', $user->id)->update([
            'wallet_balance' => $total_amount,
            'total_credit' => $transactions
        ]);
    }
}
