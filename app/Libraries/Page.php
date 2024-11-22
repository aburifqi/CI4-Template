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
        if(!isset($param['info']->url) || !isset($param['info']->name)){
            return view($this->tema .'/pages/error-404.php', $param);
        }
        if (!is_file(APPPATH.'views/' . $this->tema .'/pages/'.$param['info']->url.'/'.$param['info']->name . '.php')){
            return view($this->tema .'/pages/error-404.php', $param);
        }
        return view($this->tema .'/pages/'.$param['info']->url.'/'.$param['info']->name, $param);
    }
}