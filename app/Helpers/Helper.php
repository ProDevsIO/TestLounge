<?php

use App\Helpers\BarcodeHelper;
use App\Helpers\UserShare;

function encrypt_decrypt($action, $string)
{
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'members';
    $secret_iv = 'groupy';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function generateAbb(string $name): string
{
    $name = ucwords(strtolower($name));
    $words = explode(' ', $name);
    return strtoupper($words[0] . " " . substr(end($words), 0, 1));
}

function upComet($data)
{
    $ch = curl_init();
    https: //api-us.cometchat.io/v2.0/users/uid
    curl_setopt($ch, CURLOPT_URL, "https://api-us.cometchat.io/v2.0/users/" . $data['user_id']);
    unset($data['user_id']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'apiKey: 75d184bbfa131b191f57b6d7295828415be408a9',
        'appId: 30367331321bf26'
    ));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        http_build_query($data)
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close($ch);
}

function convertSeconds($value)
{
    $dt = \Carbon\Carbon::now();
    $days = $dt->diffInDays($dt->copy()->addSeconds($value));
    $hours = $dt->diffInHours($dt->copy()->addSeconds($value)->subDays($days));
    $minutes = $dt->diffInMinutes($dt->copy()->addSeconds($value)->subDays($days)->subHours($hours));
    return \Carbon\CarbonInterval::days($days)->hours($hours)->minutes($minutes)->forHumans();
}

function getMyRefBarcode($user  = null)
{
    $user = $user ?? auth()->user();
    if (empty($user)) {
        return null;
    }
    $barcodeHelper = new BarcodeHelper;
    $content = url('/?ref=' . $user->referal_code);
    return $barcodeHelper->generate($content);
}


function generateReferralCode($length = 16)
{
    $string = '';

    while (($len = strlen($string)) < $length) {
        $size = $length - $len;

        $bytes = random_bytes($size);

        $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
    }

    return $string;
}

function shareHelper()
{
    return new UserShare;
}


function myIP()
{
    if (!session()->has('ip')) {
        $ip = uniqid('ip_') . rand(100, 999);
        session(['ip' => $ip]);
    } else {
        $ip = session()->get('ip');
    }
    return $ip;
}
