<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        //
    }

    public function listGrupUser(){
        $sumberData = [[
            "tables" => "auth_groups",
            "fields" => "*",
            "where" => '(deleted_by = 0 OR deleted_by IS NULL OR deleted_by = "")',
            "group" => "",
            "having" => "",
            "order" => "",
        ]];

        return $this->loadDataTable($sumberData);
    }
}
