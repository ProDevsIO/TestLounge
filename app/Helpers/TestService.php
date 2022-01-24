<?php

namespace App\Helpers;

use App\Models\RegisterTest;
use App\Mail\TestReceipt;
use Illuminate\Support\Facades\Mail;


class TestService
{
    public function register($data)
    {
        return RegisterTest::create($data);
    }

    public function listTestkits()
    {
        return RegisterTest::paginate(25);
    }
    
    public function getTestById($id)
    {
        return RegisterTest::where('id', $id)->first();
    }

    public function setTestStatus($test, $stat)
    {
        $data = RegisterTest::where('id', $test->id)->update(['status' => $stat]);

        Mail::to($test->email)->send(new TestReceipt($test->id, "Test Receipt from TestLounge"));

        return $data;
    }

}


