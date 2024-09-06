<?php namespace App\Libraries;

class WidgetMenu
{
    protected $db;

    public function __construct(){
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
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
        return view(getenv("TEMA").'/widget/menu',["menu"=>$data]);
    }

    public function parentMenu($param){
        return view(getenv("TEMA").'/widget/parent_menu',$param);
    }
    
    public function actionMenu($param){
        return view(getenv("TEMA").'/widget/action_menu',$param);
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