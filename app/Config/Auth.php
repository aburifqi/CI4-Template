<?php namespace Config;

use Myth\Auth\Config\Auth as MythAuth;

class Auth extends MythAuth
{
    // Override properties or methods here
    public $sessionExpiration = 7200; // contoh mengubah waktu kedaluwarsa sesi
    public $views = [
        'login'       => '\Auth\login',
        'register'    => '\Auth\register',
        'forgot'      => 'Myth\Auth\Views\forgot',
        'reset'       => 'Myth\Auth\Views\reset',
        'emailForgot' => 'Myth\Auth\Views\emails\forgot',
        // 'register'    => 'Myth\Auth\Views\register',
        // 'forgot'      => 'Myth\Auth\Views\forgot',
        // 'reset'       => 'Myth\Auth\Views\reset',
        // 'emailForgot' => 'Myth\Auth\Views\emails\forgot',
    ];

    public $requireActivation = null;
    public $defaultUserGroup = "User";
}