<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddData extends Migration
{
    public function up()
    {
        $this->forge->addField([
			// Essentials
			'id' => ['type' => 'INT','constraint' => 11,'auto_increment' => TRUE,],
			'name' => ['type' => 'VARCHAR','constraint' => 255],
			'email' => ['type' => 'VARCHAR','constraint' => 255,'UNIQUE' => TRUE,],
			'no_hp' => ['type' => 'VARCHAR','constraint' => 255,'null' => TRUE,],
			// Timestamps			
			'created_at' => ['type' => 'DATETIME','null' => TRUE,],
			'updated_at' => ['type' => 'DATETIME','null' => TRUE,],
			'deleted_at' => ['type' => 'DATETIME','null' => TRUE,],
		]);
		$this->forge->addKey('id', true);	
		$this->forge->createTable('data');
    }

    public function down()
    {
        $this->forge->dropTable('data');
    }
}
