<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthUserPermissionsSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id'           => 1,
                'permission_id'     => 1,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 2,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 3,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 4,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 5,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 6,
            ],
        ];

        $this->db->table('auth_users_permissions')->insertBatch($data);
    }
}
