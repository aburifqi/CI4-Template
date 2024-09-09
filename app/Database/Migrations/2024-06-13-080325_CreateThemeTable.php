<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateThemeTable extends Migration
{
    public function up()
    {
        // Themes
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'logo' => ['type' => 'varchar', 'constraint' => 50],
            'theme' => ['type' => 'varchar', 'constraint' => 50],
            'is_default' => ['type' => 'tinyint', 'default' => '0'],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('themes', true);
    }

    public function down()
    {
        // Themes
        $this->forge->dropTable('themes', true);
    }
}