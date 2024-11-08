<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        return view($this->tema. '\\index');
    }
}
