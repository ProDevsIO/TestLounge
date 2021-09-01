<?php

namespace App\Helpers;

use App\Models\User;


class BookingService
{

    public $sub_accounts = [];
    public $user_id;
    public $referral_code;
    public $user;
    public $superAgent;

    public function getSubAccountsByRefCode($referal_code)
    {
        $user = User::where('referal_code', $referal_code)->first();

        if (!empty($user)) {
            $this->user = $user;
            $this->referral_code = $user->referal_code;
            $this->user_id = $user->id;
            
            if (!empty($user->flutterwave_key)) {
                $this->generateSubAccountData();
            }
        }
        return $this;
    }

    public function processRequestData(array $data)
    {
        $data["referral_code"] = $this->referral_code;
        $data["user_id"] = $this->user_id;
        return $data;
    }

    public function generateSubAccountData()
    {
        $userService = new UserShare;
        $agent_share = $userService->myShare($this->user);
        $share_data = $userService->calculateMainAgentShare($this->user->main_agent_share_raw, $agent_share);


        $agent_transaction_charge = (100 - $share_data["sub_agent_share"]) / 100;
        $super_agent_transaction_charge = (100 - $share_data["main_agent_share_percent"]) / 100;

        $this->sub_accounts[] = [
            "id" => [$this->user->flutterwave_key],
            "transaction_charge_type" => "percentage",
            "transaction_charge" => $agent_transaction_charge
        ];

        if (
            !empty($share_data["main_agent_share_raw"]) &&
            !empty($superAgent = $this->user->superAgent) &&
            !empty($key = $superAgent->flutterwave_key)
        ) {
            $this->superAgent = $superAgent;
            $this->sub_accounts[] = [
                "id" => [$key],
                "transaction_charge_type" => "percentage",
                "transaction_charge" => $super_agent_transaction_charge
            ];
        }


    }
}
