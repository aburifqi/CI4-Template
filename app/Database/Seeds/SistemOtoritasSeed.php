<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SistemOtoritasSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'auth_permissions_id'       => 1,
                'judul'                     => 'Pengaturan',
                'icon'                      => 'mdi mdi-settings',
                'icon_color'                => '#ffab00',
                'jenis'                     => 'Menu',
                'parent_id'                 => 0,
                'urut'                      => 0,
                'url'                       => '',
                'is_page'                   => 0,
                'status'                    => 'active',
            ],
            [
                'auth_permissions_id'       => 2,
                'judul'                     => 'Desain Menu',
                'icon'                      => 'mdi mdi-menu',
                'icon_color'                => 'rgb(182, 215, 168)',
                'jenis'                     => 'Menu',
                'parent_id'                 => 1,
                'urut'                      => 0,
                'url'                       => 'pengaturan',
                'is_page'                   => 1,
                'status'                    => 'active',
            ],
            [
                'auth_permissions_id'       => 3,
                'judul'                     => 'Lihat Desain Menu',
                'icon'                      => '',
                'icon_color'                => '',
                'jenis'                     => 'Action',
                'parent_id'                 => 2,
                'urut'                      => 0,
                'url'                       => '',
                'is_page'                   => 0,
                'status'                    => 'active',
            ],
            [
                'auth_permissions_id'       => 4,
                'judul'                     => 'Tambah Menu',
                'icon'                      => '',
                'icon_color'                => '',
                'jenis'                     => 'Action',
                'parent_id'                 => 2,
                'urut'                      => 1,
                'url'                       => '',
                'is_page'                   => 1,
                'status'                    => 'active',
            ],
            [
                'auth_permissions_id'       => 5,
                'judul'                     => 'Edit Menu',
                'icon'                      => '',
                'icon_color'                => '',
                'jenis'                     => 'Action',
                'parent_id'                 => 2,
                'urut'                      => 2,
                'url'                       => '',
                'is_page'                   => 1,
                'status'                    => 'active',
            ],
            [
                'auth_permissions_id'       => 6,
                'judul'                     => 'Hapus Menu',
                'icon'                      => '',
                'icon_color'                => '',
                'jenis'                     => 'Action',
                'parent_id'                 => 2,
                'urut'                      => 3,
                'url'                       => '',
                'is_page'                   => 0,
                'status'                    => 'active',
            ],
        ];

        $this->db->table('sistem_otoritas')->insertBatch($data);
    }
}
