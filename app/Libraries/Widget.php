<?php namespace App\Libraries;

class Widget
{
    protected $db;

    public function __construct(){
        $this->db      = \Config\Database::connect();
    }

    public function menu()
    {
        $sql = 'SELECT 
                    so.*, 
                    0 AS level,
                    ap.name,
                    ap.description
                FROM sistem_otoritas so
                JOIN auth_permissions ap ON ap.id = so.auth_permissions_id
                JOIN auth_users_permissions aup ON aup.permission_id = ap.id
                WHERE so.parent_name = "" AND so.jenis="Menu" AND so.status = "active" AND aup.user_id = :user_id:
                ORDER BY so.urut
        ';
        $query = $this->db->query($sql, ["user_id"=>user()->id]);
        $data = $query->getResultArray();
        if(sizeof($data)){
            $data = $this->getMenuAnak($data, 1);
        }
        return view(getenv("TEMA").'/widget/menu',["menu"=>$data]);
    }

    public function parentMenu($param){
        return view(getenv("TEMA").'/widget/parent_menu',$param);
    }
    
    public function actionMenu($param){
        return view(getenv("TEMA").'/widget/action_menu',$param);
    }

    public function breadcrumbs($param){
        return view(getenv("TEMA").'/widget/breadcrumbs',["breadCrumbs"=>$param]);
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
                JOIN auth_users_permissions aup ON aup.permission_id = ap.id
                WHERE so.parent_name = :parent_name: AND so.jenis="Menu" AND so.status = "active" AND aup.user_id = :user_id:
                ORDER BY so.urut
            ';
            $dt['level'] = $level;
            $dt['anak'] = $this->db->query($sql, [
                'parent_name'     => $dt['name'],
                "user_id"       => user()->id
            ])->getResultArray();
            if(sizeof($dt['anak'])){
                $dt['anak'] = $this->getMenuAnak($dt['anak'], $level++);
            }
            return $dt;
        }, $data);
        return $hasil;
    }
}