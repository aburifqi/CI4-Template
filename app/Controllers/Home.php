<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $theme = getenv("TEMA");
        return view($theme. '\\index');
    }
}
