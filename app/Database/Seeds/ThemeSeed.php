<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ThemeSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'logo'          => 'coronadark',
                'theme'         => 'coronadark',
                'is_default'    => 1,
                'pilih'         => 1
            ],
        ];

        $this->db->table('themes')->insertBatch($data);
    }
}
