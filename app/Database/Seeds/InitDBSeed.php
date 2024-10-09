<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitDBSeed extends Seeder
{
    public function run()
    {
        $this->call('ThemeSeed');
        $this->call('AuthGroupSeed');
        $this->call('UserSeed');
        $this->call('AuthGroupUserSeed');
        $this->call('PermissionsSeed');
        $this->call('AuthGroupPermissionsSeed');
        $this->call('AuthUserPermissionsSeed');
        $this->call('SistemOtoritasSeed');
        $this->call('IconsSeed');
    }
}
