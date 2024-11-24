<?php

namespace App\Controllers\Pengaturan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;
class DesainMenuController extends BaseController
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
            WHERE so.parent_name = "" AND so.status = "active" AND (so.deleted_by = 0 OR so.deleted_by IS NULL OR so.deleted_by = "") AND (ap.deleted_by = 0 OR ap.deleted_by IS NULL OR ap.deleted_by = "")
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

    public function listIcons(){
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
                WHERE so.parent_name = :parent_name: AND so.status = "active" AND (so.deleted_by = 0 OR so.deleted_by IS NULL OR so.deleted_by = "") AND (ap.deleted_by = 0 OR ap.deleted_by IS NULL OR ap.deleted_by = "")
                ORDER BY so.urut
            ';
            $dt['level'] = $level;
            $dt['anak'] = $this->db->query($sql, [
                'parent_name'     => $dt['name'],
            ])->getResultArray();
            if(sizeof($dt['anak'])){
                $dt['anak'] = $this->getMenuAnak($dt['anak'], $level++);
            }
            return $dt;
        }, $data);
        return $hasil;
    }

    function simpanMenu(){
        try {
            $this->db->transException(true)->transStart();
            // $this->db->transStart();

            $request = request();
            $data = $request->getPost('data');
            $hasil = [];
            $idSimpanPermission=[];
            $idSimpanOtoritas=[];
            if(sizeof($data)){
                foreach($data as $dt){
                    $dataAuthPermisssions = [
                        "id"=>$dt['auth_permissions_id'],
                        "name"=>$dt['name'],
                        "description"=>$dt['description'],
                    ];
                    $hasil = $this->simpan('auth_permissions', $dataAuthPermisssions,["name"=>["unik"]]);
                    if((int)$hasil['hasil']!== 1)return json_encode($hasil);
                    array_push($idSimpanPermission, $hasil['data']['id']);
                    $dt['auth_permissions_id'] = $hasil['data']['id'];
                    unset($dt['description']);
                    unset($dt['level']);
                    unset($dt['name']);
                    unset($dt['anak']);

                    $hasil = $this->simpan('sistem_otoritas', $dt);
                    if($hasil['hasil']!== 1)return json_encode($hasil);
                    array_push($idSimpanOtoritas, $hasil['data']['id']);
                }
            }
            // Yang gak kesimpan, dianggap dihapus.
            $dataPermissions = $this->db->query("SELECT * FROM auth_permissions WHERE id NOT IN (".implode(",", $idSimpanPermission).")")->getResultArray();
            $dataOtoritas = $this->db->query("SELECT * FROM sistem_otoritas WHERE id NOT IN (".implode(",", $idSimpanOtoritas).")")->getResultArray();
            if(sizeof($dataPermissions)){
                foreach($dataPermissions as $dp){
                    $this->hapus('auth_permissions', $dp);
                }
            }
            if(sizeof($dataOtoritas)){
                foreach($dataOtoritas as $do){
                    $this->hapus('sistem_otoritas', $do);
                }
            }
            $this->db->transComplete();
            // if ($this->db->transStatus() === false) {
            //     // generate an error... or use the log_message() function to log your error
            //     return json_encode([
            //         "hasil"=>0,
            //         "message"=>"Terjadi kesalahan...",
            //         "data"=>$data
            //     ]);
            // }
            return json_encode($hasil);
        } catch (DatabaseException $e) {
            // Automatically rolled back already.
            return json_encode([
                "hasil"=>0,
                "message"=>"Terjadi kesalahan...",
                "data"=>$e
            ]);
        }
    }
}
