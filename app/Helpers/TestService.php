<?php

namespace App\Helpers;

use App\Models\RegisterTest;


class TestService
{
    public function register($data)
    {

        return RegisterTest::create($data);

    }
}

