<?php namespace App\Libraries;

class Page
{

    protected $db;
    protected $tema;
    public function __construct(){
        $this->db      = \Config\Database::connect();
        //Untuk tema, pilih ini
        // $this->theme = getenv("TEMA");
        //atau yang ini
        $theme = $this->db->query("SELECT * FROM themes WHERE pilih = 1 LIMIT 1")->getFirstRow();
        $theme = $theme->theme ;
        $this->tema = $theme;
    }

    public function openPage($param)
    {
        // if (is_file(APPPATH.'views/' . $my_view . EXT))
        if ($this->load->view($this->tema .'/pages/'.$param['url'].'/'.$param['page'], $param,TRUE)!== ''){
            return view($this->tema .'/pages/'.$param['url'].'/'.$param['page'], $param);

        }else{
            return 'Gak ada file';
        }
    }
}