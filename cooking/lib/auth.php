<?php

namespace Lib;

class Auth
{

    private static $user_logged = false;
    private static $user_info = array();

    private function __construct()
    {
        session_set_cookie_params(1800, "/");
        session_start();
    }

    public function login($username, $password)
    {

    }

}