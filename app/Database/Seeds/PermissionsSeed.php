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
            [
                'name' => 'manajemen_user',
                'description'    => '',
            ],
            [
                'name' => 'grup_user',
                'description'    => '',
            ],
            [
                'name' => 'lihat_grup_user',
                'description'    => '',
            ],
            [
                'name' => 'tambah_grup_user',
                'description'    => '',
            ],
            [
                'name' => 'edit_grup_user',
                'description'    => '',
            ],
            [
                'name' => 'hapus_grup_user',
                'description'    => '',
            ],
            [
                'name' => 'daftar_user',
                'description'    => '',
            ],
            [
                'name' => 'lihat_daftar_user',
                'description'    => '',
            ],
            [
                'name' => 'tambah_daftar_user',
                'description'    => '',
            ],
            [
                'name' => 'edit_daftar_user',
                'description'    => '',
            ],
            [
                'name' => 'hapus_daftar_user',
                'description'    => '',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);
    }
}
