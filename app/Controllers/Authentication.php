<?php

namespace App\Controllers;

class Authentication extends BaseController
{
    public function login_view()
    {
        return view('auth/login');
    }

    public function register_view()
    {
        return view('auth/register');
    }
}