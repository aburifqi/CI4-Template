<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIconsTable extends Migration
{
    public function up()
    {
        // `id`, `font`, `versi`, `kode`, `nama`
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'font' => ['type' => 'varchar', 'constraint' => 50],
            'versi' => ['type' => 'varchar', 'constraint' => 10],
            'kode' => ['type' => 'varchar', 'constraint' => 50],
            'nama' => ['type' => 'varchar', 'constraint' => 50],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('icons', true);
    }

    public function down()
    {
        $this->forge->dropTable('icons', true);
    }
}
