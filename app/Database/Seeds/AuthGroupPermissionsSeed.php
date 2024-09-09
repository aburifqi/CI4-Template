<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupPermissionsSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'group_id'          => 3,
                'permission_id'     => 1,
            ],
            [
                'group_id'          => 3,
                'permission_id'     => 2,
            ],
            [
                'group_id'          => 3,
                'permission_id'     => 3,
            ],
            [
                'group_id'          => 3,
                'permission_id'     => 4,
            ],
            [
                'group_id'          => 3,
                'permission_id'     => 5,
            ],
            [
                'group_id'          => 3,
                'permission_id'     => 6,
            ],
        ];

        $this->db->table('auth_groups_permissions')->insertBatch($data);
    }
}
