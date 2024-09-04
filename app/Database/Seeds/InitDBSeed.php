<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitDBSeed extends Seeder
{
    public function run()
    {
        $this->call('AuthGroupSeed');
        $this->call('UserSeed');
        $this->call('AuthGroupUserSeed');
    }
}
