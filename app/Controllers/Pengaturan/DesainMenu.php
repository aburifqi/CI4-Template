<?php

namespace App\Controllers\Pengaturan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DesainMenu extends BaseController
{
    public function index()
    {
        //
    }

    public function getMenu(){
        $sql = 'SELECT 
                    so.*, 
                    0 AS level,
                    ap.name,
                    ap.description
                FROM sistem_otoritas so
                JOIN auth_permissions ap ON ap.id = so.auth_permissions_id
                WHERE so.parent_id = 0 AND so.jenis="Menu" AND so.status = "active"
                ORDER BY so.urut
        ';

        $query = $this->db->query($sql);
        $data = $query->getResultArray();
        if(sizeof($data)){
            $data = $this->getMenuAnak($data, 1);
        }
        return json_encode([
            "data"=>$data
        ]);
    }

    public function getIcons(){
        $sumberData = [[
            "tables" => "icons",
            "fields" => "*",
            "where" => "",
            "group" => "",
            "having" => "",
            "order" => "",
        ]];

        return $this->loadDataTable($sumberData);
    }

    function getMenuAnak($data, $level){
        $hasil = array_map(function($dt) use($level) {
            $sql = '
                SELECT 
                    so.*,
                    ap.name,
                    ap.description
                FROM sistem_otoritas so
                JOIN auth_permissions ap ON ap.id = so.auth_permissions_id
                WHERE so.parent_id = :parent_id: AND so.jenis="Menu" AND so.status = "active"
                ORDER BY so.urut
            ';
            $dt['level'] = $level;
            $dt['anak'] = $this->db->query($sql, [
                'parent_id'     => $dt['id'],
            ])->getResultArray();
            if(sizeof($dt['anak'])){
                $dt['anak'] = $this->getMenuAnak($dt['anak'], $level++);
            }
            return $dt;
        }, $data);
        return $hasil;
    }
}
