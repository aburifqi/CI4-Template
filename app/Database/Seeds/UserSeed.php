<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email' => 'aburifqihanifalmuyassar@gmail.com',
                'username'    => 'dev',
                'password_hash'    => '$2y$10$/uHoSEA7eI323StckX5Zg.8rI/APhgSu7gpoXs6Keu5DXNTM/AZzG',
                'active'    => 1,
                'force_pass_reset'    => 0,
                'full_name'    => 'Developer',
                'user_image'    => 'default-user.png',
            ],
            [
                'email' => 'admin@mail.com',
                'username'    => 'admin',
                'password_hash'    => '$2y$10$/uHoSEA7eI323StckX5Zg.8rI/APhgSu7gpoXs6Keu5DXNTM/AZzG',
                'active'    => 1,
                'force_pass_reset'    => 0,
                'full_name'    => 'Administrator',
                'user_image'    => 'default-user.png',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
