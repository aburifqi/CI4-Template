<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Files\File;
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['auth'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    protected $db;
    protected $tema;
    protected $otoritas;
    public function __construct(){
        $this->db      = \Config\Database::connect();
        //Untuk tema, pilih ini
        // $this->theme = getenv("TEMA");
        //atau yang ini
        $theme = $this->db->query("SELECT * FROM themes WHERE pilih = 1 LIMIT 1")->getFirstRow();
        $theme = $theme->theme ;
        $this->tema = $theme;
        $sql = '
            SELECT 
                ap.name 
            FROM auth_users_permissions aup
            JOIN auth_permissions ap ON ap.id = aup.permission_id
            WHERE aup.user_id = :user_id: AND (ap.deleted_by = 0 OR ap.deleted_by IS NULL OR ap.deleted_by = "")
        ';

        $otoritas = [];
        $arrOtoritas = $this->db->query($sql, ['user_id' => user()->id])->getResultArray();

        if(sizeof($arrOtoritas)){
            foreach($arrOtoritas as $otr){
                array_push($otoritas, $otr['name']);
            }
        }

        $this->otoritas = $otoritas;
    }

    public function loadDataTable($sumberData =[[
        "tables" => "",
        "fields" => "",
        "where" => "",
        "group" => "",
        "having" => "",
        "order" => "",
    ]]){
        $request = request();

        if(!sizeof($sumberData)){
            $json_data = array(
                "draw"            => intval($request->getPost('draw')),  
                "recordsTotal"    => 0,  
                "recordsFiltered" => 0, 
                "data"            => [],
            );
    
            return json_encode($json_data); 
        }
        global $db;
        $queryAll = 'SELECT * FROM (';
        $queryCountAll = 'SELECT COUNT(*) AS total FROM (';
        foreach($sumberData as $idx => $sd){
            $strQuery = '';
            if($idx >0) $strQuery .= ' UNION ALL ';
            $tables = $sd['tables'] ?? '';
            $fields = $sd['fields'] ?? '';
            $where = $sd['where'] ?? '';
            $group = $sd['group'] ?? '';
            $having = $sd['having'] ?? '';
            $order = $sd['order'] ?? '';
            $strQuery .= "SELECT $fields FROM $tables";
            $strQuery .= $where? " WHERE $where":"";
            $strQuery .= $group? " GROUP BY $group":"";
            $strQuery .= $having? " HAVING $having":"";
            $strQuery .= $order? " ORDER BY $order":"";
            $queryAll .= $strQuery;
            $queryCountAll .= $strQuery;
        }
        $queryAll .= ') all_data';
        $queryCountAll .= ') all_data';
        $limit = $request->getPost('length') ?? -1;
        $start = $request->getPost('start');
        $strOrder = '';
        if(!empty($request->getPost('order'))){
            $order = $request->getPost('order')['0']['name'];
            $order = explode('|', $order);
            $order =$order[0];
            $dir = $request->getPost('order')['0']['dir'];
            $strOrder = "ORDER BY $order $dir ";
        }

        $strLimit = '';
        if ($limit && $limit>=0){
            $strLimit .= "LIMIT $limit OFFSET $start";
        }
        // Filter
        $strWhere = '';
        $bindings = [];
        $searchFromFront = $request->getPost('searchmode')=='front'?'':'%';
        // Filter dari satu input box
        if(!empty($request->getPost('search')['value']))
        {    
            $search = $request->getPost('search')['value'];
            $bindings = [
                "search"=>$search
            ];

            $strCondition = "";
            if (sizeof($request->getPost('columns'))>0){
                foreach($request->getPost('columns') as $column){
                    if ($column['name']){
                        $fieldName = explode('|',$column['name']);
                        if ($fieldName[0]){
                            switch($fieldName[1]){
                                case 'input':
                                case 'select':
                                case 'number-range':
                                    $strWhere = " WHERE ";
                                    $strCondition .= $strCondition? ' or ': '';
                                    $strCondition .= $fieldName[0] . " LIKE ".$searchFromFront .":search:%";
                                break;
                                case 'date-range-picker':
                                    if (is_numeric($search)){
                                        $strWhere = " WHERE ";
                                        $strCondition .= $strCondition? ' or ': '';
                                        $strCondition .= ' Day('. $fieldName[0] . ") = :search:";
                                        $strCondition .= ' or Month('. $fieldName[0] . ") = :search:";
                                        $strCondition .= ' or Year('. $fieldName[0] . ") = :search:";
                                    }
                                break;
                            }
                        }
                    }
                }
            }
            $strWhere .= $strCondition;
        }
        //Cek saring per kolom
        if (sizeof($request->getPost('columns'))>0){
            $strCondition = "";
            foreach($request->getPost('columns') as $column){
                if ($column['name'] && strlen($column['search']['value'])>0){
                    $fieldName = explode('|',$column['name']);
                    if (!empty($fieldName[2])){
                        $search = $column['search']['value'];
                        $bindings[$fieldName[0]] = $search;
                        switch($fieldName[2]){
                            case 'input-item':
                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= "(".$fieldName[0] . " LIKE '".$searchFromFront .":".$fieldName[0].":%' OR ".$fieldName[1] . " LIKE ".$searchFromFront .":".$fieldName[0].":%)";
                                break;
                        }
                    }
                    else if ($fieldName[0]){
                        $search = $column['search']['value'];
                        
                        switch($fieldName[1]){
                            case 'input':
                                $bindings[$fieldName[0]] = $searchFromFront . $search ."%";
                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= $fieldName[0] . " LIKE :".$fieldName[0].":";
                                break;
                            case 'select':
                                $bindings[$fieldName[0]] = $search;
                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= $fieldName[0] . " = :".$fieldName[0].":";
                                break;
                            case 'number-range':
                                $arrRange = array_map('trim', explode('-', $search));

                                $from = $arrRange[0];
                                $to = $arrRange[1];
                                $bindings[$fieldName[0]."-from"] = $from;
                                $bindings[$fieldName[0]."-to"] = $to;
                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= $fieldName[0] . " >= :".$fieldName[0]."-from:";
                                $strCondition .= ' and '.$fieldName[0] . " <= :".$fieldName[0]."-to:";
                                break;
                            case 'date-range-picker':
                                $arrRange = array_map('trim', explode('-', $search));

                                $tanggal = str_replace('/', '-', $arrRange[0]);
                                $tglMulai = date('Y-m-d', strtotime($tanggal));
                                $tanggal = str_replace('/', '-', $arrRange[1]);
                                $tglAkhir = date('Y-m-d', strtotime($tanggal));

                                $bindings[$fieldName[0]."-tgl-mulai"] = $tglMulai;
                                $bindings[$fieldName[0]."-tgl-akhir"] = $tglAkhir;

                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= ' DATE (' .$fieldName[0] . ") >= :".$fieldName[0]."-tgl-mulai:";
                                $strCondition .= ' and DATE('.$fieldName[0] . ") <= :".$fieldName[0]."-tgl-akhir:";
                                break;
                            case 'date-range-picker-integer':
                                $arrRange = array_map('trim', explode('-', $search));

                                $tanggal = str_replace('/', '-', $arrRange[0]);
                                $tglMulai = date('Y-m-d', strtotime($tanggal));
                                $tanggal = str_replace('/', '-', $arrRange[1]);
                                $tglAkhir = date('Y-m-d', strtotime($tanggal));

                                $bindings[$fieldName[0]."-tgl-mulai"] = strtotime($tglMulai);
                                $bindings[$fieldName[0]."-tgl-akhir"] = strtotime($tglAkhir.' 23:59:59');

                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= ' (' .$fieldName[0] . ") >= :".$fieldName[0]."-tgl-mulai:";
                                $strCondition .= ' and ('.$fieldName[0] . ") <= :".$fieldName[0]."-tgl-akhir:";
                                break;
                            
                        }
                    }
                    else{
                        switch($fieldName[1]){
                            case "custom":
                                $search = $column['search']['value'];
                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' AND ': '';
                                $strCondition .= ($search);
                                    
                            break;
                        }
                    }
                }
            }
            $strWhere .= $strCondition;
        }
        
        $queryData = "$queryAll $strWhere $strOrder $strLimit";
        $queryCountFilter = "$queryCountAll $strWhere";
        $data = $this->db->query($queryData, $bindings)->getResultArray();
        // return json_encode($this->db->query($queryCountAll, $bindings)->getResultArray());
        $totalData = $this->db->query($queryCountAll, $bindings)->getResultArray()[0]['total'];
        $totalFiltered = $this->db->query($queryCountFilter, $bindings)->getResultArray()[0]['total'];

        $json_data = array(
            "draw"            => intval($request->getPost('draw')),  
            "recordsTotal"    => !empty($request->getPost('length')) && $totalData > $request->getPost('length') ? intval($totalData) : $request->getPost('length'),  
            "recordsFiltered" => !empty($request->getPost('length')) && $totalFiltered > $request->getPost('length') ? intval($totalFiltered): $request->getPost('length') , 
            "data"            => $data,
            // "post"			  => $_POST,
            // "limit"			  => $limit,
            // "query"			  => $queryData,
        );

        return json_encode($json_data); 
    }

    function getClientIP() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function cekValidasi($tabel="", $data=[], $aturan=[], $pesanError=[], $namaKolomId='id', $err = []){
        $errResult = [];
        $isValid = true;

        if(sizeof($aturan)){
            foreach($aturan as $key => $atr){
                if($key == "details"){
                    foreach($atr as $tabelDetail=>$aturanDetail){
                        if(!isset($data['details'][$tabelDetail])){
                            $data['details'][$tabelDetail] = [];
                        }
                        if(sizeof($data['details'][$tabelDetail])){
                            foreach($data['details'][$tabelDetail] as $row=>$rowData){
                                $validasiDetail = $this->cekValidasi($tabelDetail, $rowData, $aturanDetail, $pesanError['details'][$tabelDetail] ?? [],'id',$err);
                                if($validasiDetail['hasil']>0){
                                    $isValid = false;
                                    array_push($errResult,[$tabelDetail => [$row => $validasiDetail['error']]]);
                                }else{
                                    $data['details'][$tabelDetail][$row] =  $validasiDetail['data'];
                                }
                            }
                        }
                    }
                }else{
                    foreach($atr as $hukum => $prop){
                        if(is_array($prop)){
                            switch($hukum){
                                case "auto":
                                    if(!(int)$data[$namaKolomId]){
                                        // Generate kode baru
                                        $format = $prop['format'];
                                        $resetPer = $prop['reset_per'] ?? '';
                                        $fieldTanggal = $prop['field_tanggal'] ?? '';
    
                                        $startIndex = strpos($format, "#");
                                        $isCukup = false;
                                        $panjangIndex = 1;
                                        $strReplace = "";
                                        for($i = ($startIndex+1); ($i<=strlen($format)||!$isCukup); $i++){
                                            if(substr($format, $i, 1)!== "#"){
                                                $isCukup =true;
                                            }
                                            $strReplace .= "#";
                                            $panjangIndex++;
                                        }
                                        $queryMaks = "SELECT COALESCE(MAX($key),0) AS maks FROM $tabel";
                                        $bindingQueryMaks=[];
                                        if($resetPer){
                                            $filter = '';
                                            switch ($resetPer){
                                                case "tahun":
                                                    $filter = " WHERE YEAR(created_at) = :tahun_buat:";
                                                    $bindingQueryMaks['tahun_buat'] = date('Y');
                                                    if($fieldTanggal){
                                                        $filter = " WHERE YEAR($fieldTanggal) = = :tahun_buat:";
                                                        $bindingQueryMaks['tahun_buat'] = date('Y', strtotime($data[$fieldTanggal]));
                                                    }
                                                break;
                                                case "bulan":
                                                    $filter = " WHERE YEAR(created_at) = :tahun_buat: AND MONTH(created_at) = :bulan_buat:";
                                                    $bindingQueryMaks['tahun_buat'] = date('Y');
                                                    $bindingQueryMaks['bulan_buat'] = date('m');
                                                    if($fieldTanggal){
                                                        $filter = " WHERE YEAR($fieldTanggal) = :tahun_buat: AND MONTH($fieldTanggal) = :bulan_buat:";
                                                        $bindingQueryMaks['tahun_buat'] = date('Y', strtotime($data[$fieldTanggal]));
                                                        $bindingQueryMaks['bulan_buat'] = date('m', strtotime($data[$fieldTanggal]));

                                                    }
                                                break;
                                                case "hari":
                                                    $filter = " WHERE DATE(created_at) = :tanggal_buat:";
                                                    $bindingQueryMaks['tanggal_buat'] = date('Y-m-d');
                                                    if($fieldTanggal){
                                                        $filter = " WHERE YEAR($fieldTanggal) = :tanggal_buat:";
                                                        $bindingQueryMaks['tanggal_buat'] = date('Y-m-d', strtotime($data[$fieldTanggal]));
                                                    }
                                                break;
                                            }
                                            $queryMaks .= $filter;
                                        }
                                        $maks = $this->db->query($queryMaks, $bindingQueryMaks)->getRow()->maks;
                                        $maks = $maks?(int) substr($maks, $startIndex, $panjangIndex):0;
                                        $maks++;
                                        $maks = sprintf("%0".$panjangIndex."d", $maks);
    
                                        $data[$key] = str_replace($strReplace, $maks, $format);
                                        // Jika format mengandung sistem penanggalan
                                        $monRome = "";
                                        switch(!$fieldTanggal?date('m'): date('m', strtotime($data[$fieldTanggal]))){
                                            case 1:
                                                $monRome = "I";
                                                break;
                                            case 2:
                                                $monRome = "II";
                                                break;
                                            case 3:
                                                $monRome = "III";
                                                break;
                                            case 4:
                                                $monRome = "IV";
                                                break;
                                            case 5:
                                                $monRome = "V";
                                                break;
                                            case 6:
                                                $monRome = "VI";
                                                break;
                                            case 7:
                                                $monRome = "VII";
                                                break;
                                            case 8:
                                                $monRome = "VIII";
                                                break;
                                            case 9:
                                                $monRome = "IX";
                                                break;
                                            case 10:
                                                $monRome = "X";
                                                break;
                                            case 11:
                                                $monRome = "XI";
                                                break;
                                            case 12:
                                                $monRome = "XII";
                                                break;
                                        }
                                        $data[$key] = str_replace('[YY]', (!$fieldTanggal?date('y'): date('y', strtotime($data[$fieldTanggal]))), $data[$key]);
                                        $data[$key] = str_replace('[YYYY]', (!$fieldTanggal?date('Y'): date('Y', strtotime($data[$fieldTanggal]))), $data[$key]);
                                        $data[$key] = str_replace('[M]', (!$fieldTanggal?date('n'): date('n', strtotime($data[$fieldTanggal]))), $data[$key]);
                                        $data[$key] = str_replace('[MM]', (!$fieldTanggal?date('m'): date('m', strtotime($data[$fieldTanggal]))), $data[$key]);
                                        $data[$key] = str_replace('[MR]', $monRome, $data[$key]);
                                        $data[$key] = str_replace('[DD]', (!$fieldTanggal?date('d'): date('d', strtotime($data[$fieldTanggal]))), $data[$key]);
                                        $data[$key] = str_replace('[D]', (!$fieldTanggal?date('j'): date('j', strtotime($data[$fieldTanggal]))), $data[$key]);
                                    }
                                break;
                                case "compare":
                                    foreach($prop as $comp=>$nilai){
                                        switch($comp){
                                            case ">":
                                                if($data[$key] <= $nilai){
                                                    $isValid = false;
                                                    array_push($errResult, [$key => [$comp => $pesanError[$key] ?? "Data $key harus lebih besar dari $nilai"]]);
                                                }
                                            break;
                                            case ">=":
                                                if($data[$key] < $nilai){
                                                    $isValid = false;
                                                    array_push($errResult, [$key => [$comp => $pesanError[$key] ?? "Data $key harus lebih besar atau sama dengan $nilai"]]);
                                                }
                                            break;
                                            case "<":
                                                if($data[$key] >= $nilai){
                                                    $isValid = false;
                                                    array_push($errResult, [$key => [$comp => $pesanError[$key] ?? "Data $key harus lebih kecil dari $nilai"]]);
                                                }
                                            break;
                                            case "<=":
                                                if($data[$key] > $nilai){
                                                    $isValid = false;
                                                    array_push($errResult, [$key => [$comp => $pesanError[$key] ?? "Data $key harus lebih kecil atau sama dengan $nilai"]]);
                                                }
                                            break;
                                        }
                                    }
                                break;
                            }
                        }else{											
                            switch($prop){
                                case "wajib":
                                    if(!$data[$key]){
                                        // Data kosong
                                        $isValid = false;
                                        array_push($errResult, [$key => [$prop => $pesanError[$key] ?? "Data $key belum diisi"]]);
                                    }
                                break;
                                case "unik": 
                                    $queryUnik = "SELECT COUNT($namaKolomId) AS jumlah FROM $tabel WHERE $key = :kolom: AND $namaKolomId <> :id: AND (deleted_by = 0 OR deleted_by IS NULL OR deleted_by = '')";
                                    $bindingQueryUnik=[
                                        "kolom" => $data[$key],
                                        "id" => $data[$namaKolomId],
                                    ];
                                    $cekUnik = $this->db->query($queryUnik, $bindingQueryUnik)->getRow()->jumlah;
                                    if($cekUnik){
                                        // Data tidak unik
                                        $isValid = false;
                                        array_push($errResult, [$key => [$prop => $pesanError[$key] ?? "Data $key sudah pernah diisi"]]);
                                    }
                                break;
                            }
                        }
                    }
                }
            }
        }

        if(!$isValid){
            return [
                "hasil" => 1,
                "error"=> $errResult,
                "data"=>$data
            ];
        }
        
        return [
            "hasil" => 0,
            "data"=>$data
        ];
    }

    function simpanFile ($tabel, $field, $id, $img, $tmp, $ext){
        // //Simpan file jenis gambar-----------------------
        // $lokasiUpload = realpath(lokasiBase . '/uploads');

        // // Pastikan folder ada 
        // if (!file_exists(lokasiBase . "/uploads")) {
        //     mkdir(lokasiBase . "/uploads", 0777, true);
        // }

        $fotoLama = '';
        if($id){
            $fotoLama = $this->db->query("SELECT $field FROM $tabel WHERE id = :id:", ["id"=>$id])->getRow();
            $fotoLama = $fotoLama[$field];
        }
        $dataFile= "";
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf'); // valid extensions
        // $path = $lokasiUpload; // upload directory

        switch($ext){
            case "image/jpeg":
                $ext = "jpeg";
            break;
            case "image/jpg":
                $ext = "jpg";
            break;
            case "image/png":
                $ext = "png";
            break;
            case "image/gif":
                $ext = "gif";
            break;
            case "application/pdf":
                $ext = "pdf";
            break;
            default:
                $ext = "jpg";
        }

        // can upload same image using rand function
        $final_image = uniqid() . '_' . md5(uniqid()). "." . $ext;
        $dataFile = $final_image;
        // $path = $lokasiUpload."/".strtolower($final_image);
        // check's valid format
        if (in_array($ext, $valid_extensions)) {
            // $path = $strPathFoto;
            // $hasilMoveFile = move_uploaded_file($tmp, $path);
            // if (!$hasilMoveFile) {
            //     // Gagal kopi file--Masih jadi misteri
            //     // return [
            //     //     "hasil" => 0,
            //     //     "error" => $hasilMoveFile,
            //     //     "message"=>"Proses upload file $dataFile gagal...",
            //     //     "data" => $tabel,
            //     // ];
            // }
            if (! $tmp->hasMoved()) {
                $filepath = WRITEPATH . 'uploads/' . $tmp->store();
    
                // $data = ['uploaded_fileinfo' => new File($filepath)];
    
                // return view('upload_success', $data);
            }
    
        } else {
            // Ekstensi file tidak valid
            return [
                "hasil" => 0,
                "error"=>[],
                "message" => "Bukan jenis file yang valid...",
                "data" => $tabel
            ];
        }

        if($fotoLama && $dataFile){
            // if (is_file($lokasiUpload."/".$fotoLama)){
            //     unlink($lokasiUpload."/".$fotoLama);
            // }
        }
        return [
            "hasil" => 1,
            "data" => $dataFile,
            "message" => "Proses mengkopi file berhasil"
        ];
    }

    // function simpanLog ($menu, $tabel, $keterangan, $tipe){
    //     global $db, $userid;
    //     $dataLog = [
    //         "ip_address" => $this->getClientIP(),
    //         "id_user" => $userid,
    //         "menu" => $menu,
    //         "tabel"=> $tabel,
    //         "keterangan" => $keterangan,
    //         "tipe" => $tipe,
    //         "waktu" => date("Y-m-d H:i:s")
    //     ];
    //     $db->insert("logs", $dataLog);
    // }

    function simpan($tabel="", $data=[], $aturan=[], $pesanError=[], $namaKolomId='id', $idxRow = 0){
        $request = request();
        // Validasi data yang diinput 
        $cekValidasi = $this->cekValidasi($tabel, $data, $aturan, $pesanError, $namaKolomId, []);

        if($cekValidasi['hasil']>0){ 
            // Ada data yang tidak valid
            return [
                "hasil" => 2,
                "data"=> $data,
                "error"=> $cekValidasi['error'],
                "message" => "Data yang diisi tidak valid!",
            ];
        }else{
            $data = $cekValidasi['data'];
        }

        $files = $request->getFiles();
        if(!empty($files) && sizeof($files)){
            foreach($files as $key=>$file){
                // if($key == 'details')continue;
                if(is_array($file['name'])){
                    // File yang ada dalam tabel detail
                    foreach($file['name'] as $tbl=>$row){
                        if($tabel !== $tbl)continue;
                        foreach($row as $idx=>$jsn){
                            if($idx !== $idxRow)continue;
                            foreach($jsn as $fld=>$val){
                                $img = $file['name'][$tbl][$idx][$fld];
                                $tmp = $file['tmp_name'][$tbl][$idx][$fld];
                                $ext = $file['type'][$tbl][$idx][$fld];

                                $hasilSimpanFile = $this->simpanFile($tabel, $fld, $data['id'], $img, $tmp, $ext);
                                if(!$hasilSimpanFile['hasil']){
                                    return [
                                        "hasil" => 0,
                                        "data"=> $hasilSimpanFile['data'],
                                        "error"=> $hasilSimpanFile['error'],
                                        "message" => "Proses upload file gagal!",
                                    ];
                                }
                                $data[$fld] = $hasilSimpanFile["data"];
                            }
                        }
                    }
                }else{
                    $hasilSimpanFile = $this->simpanFile($tabel, $key, $data['id'], $file['name'], $file['tmp_name'], $file['type']);
                    unset($_FILES[$key]);
                    if(!$hasilSimpanFile['hasil']){
                        return [
                            "hasil" => 0,
                            "data"=> $hasilSimpanFile['data'],
                            "error"=> $hasilSimpanFile['error'],
                            "message" => "Proses upload file gagal!",
                        ];
                    }
                    $data[$key] = $hasilSimpanFile["data"];
                }
            }
        }

        // $menu = $data['menu'];
        $id = (int)$data[$namaKolomId];

        // Buang inputan yang bukan bagian dari database
        // unset($data['action']);
        unset($data[$namaKolomId]);
        // unset($data['menu']);
        $details = $data['details'] ?? [];
        if(!empty($data['details']))unset($data['details']);
        // Simpan data utama/ data header
        $data['updated_at']= date("Y-m-d H:i:s");
        $data['updated_by']= user()->id;

        if($id){
            $dataLama = $this->db->query("SELECT * FROM $tabel WHERE $namaKolomId = :id:",["id"=>$id])->getRowArray();
            $update = $this->updateTabel($tabel, $data, "$namaKolomId = :$namaKolomId:", [$namaKolomId => $id]);
            if(!$update){
                return [
                    "hasil" => 0,
                    "data"=> $dataLama,
                    "error"=> "Update tabel $tabel mengalami masalah!",
                    "message" => "Update tabel $tabel mengalami masalah!",
                ];
            }
            // $dataBaru = $this->db->query("SELECT * FROM $tabel WHERE $namaKolomId = :id:",["id"=>$id])->getRowArray();

            // $keteranganLog = "";
            // $strDataLama = "";
            // foreach($dataLama as $fldLog=>$valLog){
            //     $strDataLama .= ($strDataLama?"|":"").$fldLog." : ".$valLog;
            // }
            // $strDataBaru = "";
            // foreach($dataBaru as $fldLog=>$valLog){
            //     $strDataBaru .= ($strDataBaru?"|":"").$fldLog." : ".$valLog;
            // }
            // $keteranganLog .= "$strDataLama => $strDataBaru";
            // simpanLog($menu, $tabel, $keteranganLog, "edit");
        }else{
            $data['created_at']= date("Y-m-d H:i:s");
            $data['created_by']= user()->id;    
            $tambah = $this->insertTabel($tabel, $data);
            if(!$tambah){
                return [
                    "hasil" => 0,
                    "data"=> $data,
                    "error"=> "Tambah data tabel $tabel mengalami masalah!",
                    "message" => "Tambah data tabel $tabel mengalami masalah!",
                ];
            }
            $id = $this->db->insertID();
            // $dataBaru = $db->fetch_one("SELECT * FROM $tabel WHERE $namaKolomId = '".$db->clean($id)."'");
            // $dataBaru = $this->db->query("SELECT * FROM $tabel WHERE $namaKolomId = :id:",["id"=>$id])->getRowArray();

            // $keteranganLog = "";
            // $strDataBaru = "";
            // foreach($dataBaru as $fldLog=>$valLog){
            //     $strDataBaru .= ($strDataBaru?"|":"").$fldLog." : ".$valLog;
            // }
            // $keteranganLog .= "$strDataBaru";
            // simpanLog($menu, $tabel, $keteranganLog, "create");
        }

        $data = $this->db->query("SELECT * FROM $tabel WHERE $namaKolomId = :id:",["id"=>$id])->getRowArray();

        // Simpan data details
        if(sizeof($details)){
            foreach($details as $tbl=>$det){
                if(sizeof($det)){
                    $strIDDetail = "";
                    $idRelasi = "id_$tabel";
                    $dataSimpan = [];
                    foreach($det as $idx=>$dataDetail){
                        $dataDetail[$idRelasi] = $id;
                        // $dataDetail['menu'] = $menu;
                        $simpanDetail = $this->simpan($tbl,$dataDetail,$aturan['details'][$tbl] ?? [], $pesanError['details'][$tbl] ?? [],'id', $idx);
                        // Kalau data detail gagal disimpan, data header juga harus batal disimpan
                        switch($simpanDetail['hasil']){
                            case 0:
                                return [
                                    "hasil" => 0,
                                    "data"=> $data,
                                    "error"=> $simpanDetail,
                                    "message" => "Terjadi kesalahan!",
                                ];
                            break;
                            case 2:
                                return [
                                    "hasil" => 2,
                                    "data"=> $data,
                                    "error"=> $simpanDetail['error'],
                                    "message" => "Data yang diisi tidak valid!",
                                ];
                            break;
                        }
                        array_push($dataSimpan, $simpanDetail['data']);
                        // Kumpulkan id data yang ada diubah
                        $strIDDetail .= ($strIDDetail?",":"").$simpanDetail['data']['id'];
                    }
                    $data['details'][$tbl]=$dataSimpan;
                    // ID yang tidak ada di dalam daftar id yang diubah berarti sudah dihapus
                    $queryDataHapus = "SELECT * FROM $tbl WHERE id NOT IN ( $strIDDetail ) AND $idRelasi = '" . $this->db->escape($id) . "' AND (deleted_by = 0 OR deleted_by IS NULL OR deleted_by = '')";
                    $dataDetailHapus = $this->db->query($queryDataHapus)->getResultArray();

                    foreach($dataDetailHapus as $dataHapus){
                        // $dataHapus['menu'] = $menu;
                        $hapus = $this->hapus($tbl, $dataHapus);
                        if(!$hapus['hasil']){
                            return [
                                "hasil" => 0,
                                "data"=> $hapus['data'],
                                "error"=> "Hapus data tabel $tbl mengalami masalah!",
                                "message" => "Hapus data tabel $tbl mengalami masalah!",
                            ];
                        }
                    }
                }
        
            }
        }

        return [
            "hasil" => 1,
            "data"=> $data,
            "message" => "Data $tabel berhasil disimpan!",
        ];
    }

    function insertTabel($tabel = "", $data=[]){
        if(!$tabel) return false;
        if(!sizeof(value: $data)) return false;
        $query = "INSERT INTO $tabel (";
        $fields = [];
        $values = [];
        foreach($data as $field=>$val){
           array_push($fields, $field);
           array_push($values, $this->db->escape($val));
        }
        $query .= implode(", ", $fields) . ") VALUES (" . implode(", ", $values). ")";
        $this->db->query($query);
        return $this->db->affectedRows();
    }

    function updateTabel($tabel = "", $data=[], $kriteria="", $bindingKriteria=[]){
        if(!$tabel) return false;
        if(!sizeof($data)) return false;
        $query = "UPDATE $tabel SET ";
        $updates = [];
        foreach($data as $field=>$val){
           array_push($updates, " $field = " . $this->db->escape($val));
        }
        $query .= implode(", ", $updates);
        if($kriteria){
            $query .= " WHERE $kriteria";
        }
        $this->db->query($query, $bindingKriteria);
        return $this->db->affectedRows();
    }

    function hapus($tabel = "", $data = [], $namaKolomId='id'){
        // Hapus data header
        $update['deleted_at']= date("Y-m-d H:i:s");
        $update['deleted_by']= user()->id;
        
        $hapus = $this->updateTabel($tabel, $update, "$namaKolomId = :id:",["id"=>$data[$namaKolomId]]);

        if(!$hapus){
            return [
                "hasil" => 0,
                "data"=> $data,
                "message" => "Data $tabel gagal dihapus!"
            ];
        }
        // $dataHapus = $this->db->query("SELECT * FROM $tabel WHERE $namaKolomId = '".$this->db->escape($data[$namaKolomId])."' LIMIT 1")->getRowArray();
        // $keteranganLog = "";
        // $strDataHapus = "";
        // foreach($dataHapus as $fldLog=>$valLog){
        //     $strDataHapus .= ($strDataHapus?"|":"").$fldLog." : ".$valLog;
        // }
        // $keteranganLog .= "$strDataHapus";

        // simpanLog($data['menu'], $tabel, $keteranganLog, "delete");

        // Jika ada data detail
        // if(sizeof($dataDetail)){
            // Proses hapus data detail
        // }

        return [
            "hasil" => 1,
            "data"=> $data,
            "message" => "Data $tabel berhasil dihapus!"
        ];
    }
}
