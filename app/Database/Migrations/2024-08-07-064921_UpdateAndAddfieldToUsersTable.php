<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToUsersTable extends Migration
{
    public function up()
    {
        $addfields = [
            'full_name'          => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'user_image'         => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
       ];
       $this->forge->addColumn('users', $addfields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['full_name', 'user_image']);
    }
}
