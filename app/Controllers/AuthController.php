<?php

namespace App\Controllers;

use Myth\Auth\Controllers\AuthController as MythAuthController;

class AuthController extends MythAuthController
{
    public function login()
    {
        // No need to show a login form if the user
        // is already logged in.
        if ($this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);

            return redirect()->to($redirectURL);
        }
        $db      = \Config\Database::connect();
        //Untuk tema, pilih ini
        // $theme = getenv("TEMA");
        //atau yang ini
        $theme = $db->query("SELECT * FROM themes WHERE pilih = 1");
        $theme = $theme->getResultArray()[0]['theme'] ;
        $tema = $theme;

        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');
        return $this->_render($tema . '\\' . $this->config->views['login'], [
            'config' => $this->config,
            'theme' => $tema
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
        $db      = \Config\Database::connect();
        //Untuk tema, pilih ini
        // $theme = getenv("TEMA");
        //atau yang ini
        $theme = $db->query("SELECT * FROM themes WHERE pilih = 1");
        $theme = $theme->getResultArray()[0]['theme'] ;
        $tema = $theme;
        return $this->_render($tema . '\\' .$this->config->views['register'], [
            'config' => $this->config,
            'theme' => $tema
        ]);
    }
}