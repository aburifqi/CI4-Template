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
            "tes"=>view_cell('\App\Libraries\Page::beranda')
        ]);
    }

    public function page(){
        $request = request();

        $page = $request->getPost('page');
        $sql = '
            SELECT 
                so.*,
                ap.name,
                ap.description
            FROM sistem_otoritas so
            JOIN auth_permissions ap ON ap.id = so.auth_permissions_id
            WHERE so.id = :id:
        ';
        $query = $this->db->query($sql, [
            'id'     => $page,
        ]);
        $data = $query->getFirstRow();
        $data = $this->getMenuInduk($data);
        $renderView = '';
        try {
            $renderView = view_cell('\App\Libraries\Page::openPage', [
                'page' => $data->name,
                'data' => $data
            ]);
        }
        catch(\Exception $e) {
            $renderView = view_cell('\App\Libraries\Page::openPage', [
                'page' => 'error-404',
                'view'=> $data->judul
            ]);
        }
        return json_encode([
            "page" =>$page,
            "view"=>$renderView,
            "data"=>$data
        ]);
    }

    public function linkPage($page){
        $theme = getenv("TEMA");
        return view($theme. '\\index',["page"=>$page]);
    }

    function getMenuInduk($menu){
        $sql = '
            SELECT 
                so.*,
                ap.name,
                ap.description
            FROM sistem_otoritas so
            JOIN auth_permissions ap ON ap.id = so.auth_permissions_id
            WHERE so.id = :id:
        ';
        $query = $this->db->query($sql, [
            'id'     => $menu->id,
        ]);
        $data = $query->getFirstRow();
        $menu->induk = "cobak";
        return $menu;
    }
}
