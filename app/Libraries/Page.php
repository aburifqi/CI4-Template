<?php namespace App\Libraries;

class Page
{

    public function beranda()
    {

        return view(getenv("TEMA").'/pages/beranda');
    }
}