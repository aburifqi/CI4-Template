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
            [
                'user_id'           => 1,
                'permission_id'     => 7,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 8,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 9,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 10,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 11,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 12,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 13,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 14,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 15,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 16,
            ],
            [
                'user_id'           => 1,
                'permission_id'     => 17,
            ],
        ];

        $this->db->table('auth_users_permissions')->insertBatch($data);
    }
}
