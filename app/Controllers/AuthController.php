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

        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');
        //Untuk tema, pilih ini
        $theme = getenv("TEMA");
        //atau yang ini
        // $db = \Config\Database::connect();
        // $theme = $db->query("SELECT * FROM themes WHERE is_default = 1");
        // $theme = $theme->getResultArray()[0]['theme'] ;
        return $this->_render($theme . '\\' . $this->config->views['login'], [
            'config' => $this->config,
            'theme' => $theme
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
        $theme = getenv("TEMA");
        return $this->_render($theme . '\\' .$this->config->views['register'], [
            'config' => $this->config,
            'theme' => $theme
        ]);
    }
}