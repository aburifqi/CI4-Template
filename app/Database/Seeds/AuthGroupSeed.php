<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'description'    => 'Punya hak akses penuh atas aplikasi',
            ],
            [
                'name' => 'User',
                'description'    => 'Punya hak akses terbatas',
            ],
            [
                'name' => 'Developer',
                'description'    => 'Punya hak akses penuh dan bisa memanipulasi aplikasi',
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO auth_groups (name, description) VALUES(:name:, :description:)', $data);
        // foreach($data as $dt){
        //     $this->db->query('INSERT INTO auth_groups (name, description) VALUES(:name:, :description:)', $dt);
        // }

        // Using Query Builder
        // $this->db->table('auth_groups')->insert($data);
        $this->db->table('auth_groups')->insertBatch($data);
    }
}
