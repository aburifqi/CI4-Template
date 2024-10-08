<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSistemOtoritasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'auth_permissions_id'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'judul'                         => ['type' => 'varchar', 'constraint' => 191, 'null' => true],
            'icon'                          => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'icon_color'                    => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'jenis'                         => ['type' => 'ENUM("Menu","Action")', 'default' => 'Menu', 'null' => FALSE,],
            'parent_name'                   => ['type' => 'varchar', 'constraint' => 255, 'null' => true, 'default' => ''],
            'urut'                          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'url'                           => ['type' => 'varchar', 'constraint' => 191, 'null' => true],
            'is_page'                       => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'status'                        => ['type' => 'ENUM("active","inactive")', 'default' => 'active', 'null' => FALSE,],
            'created_at'                    => ['type' => 'datetime', 'null' => true],
            'created_by'                    => ['type' => 'datetime', 'null' => true],
            'updated_at'                    => ['type' => 'datetime', 'null' => true],
            'updated_by'                    => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('auth_permissions_id', 'auth_permissions', 'id', '', 'CASCADE');

        $this->forge->createTable('sistem_otoritas', true);
    }

    public function down()
    {
        $this->forge->dropTable('sistem_otoritas', true);
    }
}
