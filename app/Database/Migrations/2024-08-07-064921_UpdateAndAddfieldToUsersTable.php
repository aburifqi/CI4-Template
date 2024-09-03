<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToUsersTable extends Migration
{
    public function up()
    {
        $addfields = [
            'full_name'          => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'user_image'         => ['type' => 'varchar', 'constraint' => 30, 'null' => true, 'default' => 'default-user.png'],
       ];
       $this->forge->addColumn('users', $addfields);
    //    $alterfields = [
    //             'emp_name' => [
    //                 'name' => 'fullname',
    //                 'type' => 'VARCHAR',
    //                 'constraint' => '100',
    //             ],
    //     ];
    //     $this->forge->modifyColumn('employees', $alterfields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['full_name', 'user_image']);
    }
}
