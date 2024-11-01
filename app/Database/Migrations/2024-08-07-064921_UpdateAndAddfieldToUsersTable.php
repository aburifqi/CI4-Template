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

        $addfields = [
            'created_at'                    => ['type' => 'datetime', 'null' => true],
            'created_by'                    => ['type' => 'int', 'null' => true],
            'updated_at'                    => ['type' => 'datetime', 'null' => true],
            'updated_by'                    => ['type' => 'int', 'null' => true],
            'deleted_at'                    => ['type' => 'datetime', 'null' => true],
            'deleted_by'                    => ['type' => 'int', 'null' => true],
       ];
       $this->forge->addColumn('auth_permissions', $addfields);
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
        $this->forge->dropColumn('auth_permissions', ['created_at', 'created_by', 'updated_at', 'updated_by']);
    }
}
