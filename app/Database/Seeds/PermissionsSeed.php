<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionsSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'pengaturan',
                'description'    => 'Menu pengaturan',
            ],
            [
                'name' => 'desain_menu',
                'description'    => 'Menu desain menu',
            ],
            [
                'name' => 'lihat_menu',
                'description'    => 'Aksi lihat menu',
            ],
            [
                'name' => 'tambah_menu',
                'description'    => 'Aksi tambah menu',
            ],
            [
                'name' => 'edit_menu',
                'description'    => 'Aksi edit menu',
            ],
            [
                'name' => 'hapus_menu',
                'description'    => 'Aksi hapus menu',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);
    }
}
