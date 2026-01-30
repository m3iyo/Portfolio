<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Create contact messages table for form submissions.
 */
class CreateContactMessagesTable extends Migration
{
    /**
     * Apply schema changes.
     *
     * @return void
     */
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 120,
            ],
            "email" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "message" => [
                "type" => "TEXT",
            ],
            "created_at" => [
                "type" => "DATETIME",
                "null" => true,
            ],
            "updated_at" => [
                "type" => "DATETIME",
                "null" => true,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->createTable("contact_messages", true);
    }

    /**
     * Revert schema changes.
     *
     * @return void
     */
    public function down()
    {
        $this->forge->dropTable("contact_messages", true);
    }
}
