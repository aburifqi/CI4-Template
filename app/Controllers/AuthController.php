<?php

namespace App\Controllers;

use Myth\Auth\Controllers\AuthController as MythAuthController;

class AuthController extends MythAuthController
{
    protected $db;
    protected $tema;
    public function __construct(){
        $this->db      = \Config\Database::connect();
        //Untuk tema, pilih ini
        // $this->theme = getenv("TEMA");
        //atau yang ini
        $theme = $this->db->query("SELECT * FROM themes WHERE pilih = 1");
        $theme = $theme->getResultArray()[0]['theme'] ;
        $this->tema = $theme;
    }

    public function login()
    {
        // No need to show a login form if the user
        // is already logged in.
        if ($this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);

            return redirect()->to($redirectURL);
        }

        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');
        return $this->_render($this->tema . '\\' . $this->config->views['login'], [
            'config' => $this->config,
            'theme' => $this->tema
        ]);
    }

    public function register()
    {
        // check if already logged in.
        if ($this->auth->check()) {
            return redirect()->back();
        }

        // Check if registration is allowed
        if (! $this->config->allowRegistration) {
            return redirect()->back()->withInput()->with('error', lang('Auth.registerDisabled'));
        }
        // $theme = getenv("TEMA");
        return $this->_render($this->tema . '\\' .$this->config->views['register'], [
            'config' => $this->config,
            'theme' => $this->tema
        ]);
    }
}