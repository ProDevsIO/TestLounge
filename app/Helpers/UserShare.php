<?php
namespace App\Helpers;

use App\Models\Setting;
use App\Models\User;

class UserShare{

    public $setting;
    public function __construct()
    {
        $this->setting = Setting::where('id', 2)->first();
    }

    public function myShare(User $user = null)
    {
        $user = empty($user) ? auth()->user() : $user->refresh();
        return $user->percentage_split ?? $this->setting->value;
    }

    public function calculateMainAgentShare($main_agent_share_raw , $base_agent_share = null)
    {
        $base_agent_share = $base_agent_share ?? $this->setting->value;
        $main_agent_share = $main_agent_share_raw * $base_agent_share / 100;
        $sub_agent_share = $base_agent_share - $main_agent_share;

        return [
            "main_agent_share_percent" => $main_agent_share,
            "main_agent_share_raw" => $main_agent_share_raw,
            "sub_agent_share" => $sub_agent_share
        ];
    }
}
