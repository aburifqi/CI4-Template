<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

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
    public function __construct(){
        $this->db      = \Config\Database::connect();
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
        $order = $request->getPost('columns')[0]['name'];
        if(!empty($request->getPost('order'))){
            $order = $request->getPost('columns')[$request->getPost('order')['0']['column']]['name'];
        }
        if($order){
            $order = explode('|', $order);
            $order =$order[0];
        }
        $dir = 'asc';
        if(!empty($request->getPost('order'))){
            $dir = $request->getPost('order')['0']['dir'];
        }
        $strOrder = '';
        if ($order && $dir) $strOrder = "ORDER BY $order $dir ";

        $strLimit = '';
        if ($limit && $limit>=0){
            $strLimit .= "LIMIT $limit OFFSET $start";
        }
        // Filter
        $strWhere = '';
        $searchFromFront = $request->getPost('searchmode')=='front'?'':'%';
        // Filter dari satu input box
        if(!empty($request->getPost('search')['value']))
        {    
            $search = $request->getPost('search')['value'];
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
                                    $strCondition .= $fieldName[0] . " LIKE '".$searchFromFront .$db->clean($search)."%'";
                                break;
                                case 'date-range-picker':
                                    if (is_numeric($search)){
                                        $strWhere = " WHERE ";
                                        $strCondition .= $strCondition? ' or ': '';
                                        $strCondition .= ' Day('. $fieldName[0] . ") = ".$db->clean($search);
                                        $strCondition .= ' or Month('. $fieldName[0] . ") = ".$db->clean($search);
                                        $strCondition .= ' or Year('. $fieldName[0] . ") = ".$db->clean($search);
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
                        switch($fieldName[2]){
                            case 'input-item':
                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= "(".$fieldName[0] . " LIKE '".$searchFromFront .$db->clean($search)."%' OR ".$fieldName[1] . " LIKE '".$searchFromFront .$db->clean($search)."%')";
                                break;
                        }
                    }
                    else if ($fieldName[0]){
                        $search = $column['search']['value'];
                        switch($fieldName[1]){
                            case 'input':
                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= $fieldName[0] . " LIKE '".$searchFromFront .$db->clean($search)."%'";
                                break;
                            case 'select':
                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= $fieldName[0] . " = '".$db->clean($search)."'";
                                break;
                            case 'number-range':
                                $arrRange = array_map('trim', explode('-', $search));

                                $from = $arrRange[0];
                                $to = $arrRange[1];

                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= $fieldName[0] . " >= '".$db->clean($from)."'";
                                $strCondition .= ' and '.$fieldName[0] . " <= '".$db->clean($to)."'";
                                break;
                            case 'date-range-picker':
                                $arrRange = array_map('trim', explode('-', $search));

                                $tanggal = str_replace('/', '-', $arrRange[0]);
                                $tglMulai = date('Y-m-d', strtotime($tanggal));
                                $tanggal = str_replace('/', '-', $arrRange[1]);
                                $tglAkhir = date('Y-m-d', strtotime($tanggal));

                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= ' DATE (' .$fieldName[0] . ") >= '".$db->clean($tglMulai)."'";
                                $strCondition .= ' and DATE('.$fieldName[0] . ") <= '".$db->clean($tglAkhir)."'";
                                break;
                            case 'date-range-picker-integer':
                                $arrRange = array_map('trim', explode('-', $search));

                                $tanggal = str_replace('/', '-', $arrRange[0]);
                                $tglMulai = date('Y-m-d', strtotime($tanggal));
                                $tanggal = str_replace('/', '-', $arrRange[1]);
                                $tglAkhir = date('Y-m-d', strtotime($tanggal));

                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= ' (' .$fieldName[0] . ") >= '".strtotime($tglMulai)."'";
                                $strCondition .= ' and ('.$fieldName[0] . ") <= '".strtotime($tglAkhir.' 23:59:59')."'";
                                break;
                            case 'empty-date-range-picker-integer':
                                $arrRange = array_map('trim', explode('-', $search));

                                $tanggal = str_replace('/', '-', $arrRange[0]);
                                $tglMulai = date('Y-m-d', strtotime($tanggal));
                                $tanggal = str_replace('/', '-', $arrRange[1]);
                                $tglAkhir = date('Y-m-d', strtotime($tanggal));

                                $strWhere = " WHERE ";
                                $strCondition .= $strCondition? ' and ': '';
                                $strCondition .= ' (' .$fieldName[0] . ") >= '".strtotime($tglMulai)."'";
                                $strCondition .= ' and ('.$fieldName[0] . ") <= '".strtotime($tglAkhir.' 23:59:59')."'";
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
        $data = $this->db->query($queryData)->getResultArray();//$db->fetch_all($queryData);
        $totalData = $db->fetch_one($queryCountAll)['total'];
        $totalFiltered = $db->fetch_one($queryCountFilter)['total'];

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
}
