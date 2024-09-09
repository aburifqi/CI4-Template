<?php namespace App\Libraries;

class Page
{

    public function openPage($param)
    {
        return view(getenv("TEMA").'/pages/'.$param['url'].'/'.$param['page'], $param);
    }
}