<?php

namespace App\Controllers;

class Sistem extends BaseController
{
    public function index(): string
    {
        return "";
    }
    public function menu()
    {
        $sql = 'SELECT 
                    ha.*, "" as "children"
                FROM sistem_otoritas ha
                JOIN sistem_otoritas_user_group haug ON haug.otoritas_code = ha.code
                JOIN auth_groups ug ON ug.id = haug.user_group_id
                JOIN auth_groups_users agu ON agu.group_id = ug.id
                JOIN users us ON us.id = agu.user_id
                WHERE us.id = :id_user: AND ha.type="Menu" AND ha.status = "active"
                ORDER BY ha.urut';
        $query = $this->db->query($sql, [
            'id_user'     => 2,
        ]);
        $data = $query->getResultArray();
        return json_encode([
            "hasil"=>1,
            "data"=>$data,
            "ID"=>user()->id
        ]);
    }
}
