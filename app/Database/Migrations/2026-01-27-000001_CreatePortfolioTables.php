<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Create portfolio tables for dynamic content.
 */
class CreatePortfolioTables extends Migration
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
            "kicker" => [
                "type" => "VARCHAR",
                "constraint" => 200,
            ],
            "headline" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "subheadline" => [
                "type" => "TEXT",
            ],
            "resume_url" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "contact_url" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true,
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
        $this->forge->createTable("profiles", true);

        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "profile_id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
            ],
            "label" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "tag_class" => [
                "type" => "VARCHAR",
                "constraint" => 50,
                "default" => "is-info",
            ],
            "display_order" => [
                "type" => "INT",
                "constraint" => 5,
                "default" => 0,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->addKey("profile_id");
        $this->forge->addForeignKey("profile_id", "profiles", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("profile_tags", true);

        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "label" => [
                "type" => "VARCHAR",
                "constraint" => 50,
            ],
            "url" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "icon_url" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "display_order" => [
                "type" => "INT",
                "constraint" => 5,
                "default" => 0,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->createTable("social_links", true);

        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 100,
            ],
            "layout" => [
                "type" => "VARCHAR",
                "constraint" => 20,
                "default" => "tags",
            ],
            "display_order" => [
                "type" => "INT",
                "constraint" => 5,
                "default" => 0,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->createTable("skill_groups", true);

        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "group_id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
            ],
            "label" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "icon_url" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true,
            ],
            "description" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true,
            ],
            "display_order" => [
                "type" => "INT",
                "constraint" => 5,
                "default" => 0,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->addKey("group_id");
        $this->forge->addForeignKey("group_id", "skill_groups", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("skills", true);

        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "title" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "display_order" => [
                "type" => "INT",
                "constraint" => 5,
                "default" => 0,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->createTable("projects", true);

        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "project_id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
            ],
            "label" => [
                "type" => "VARCHAR",
                "constraint" => 100,
            ],
            "tag_class" => [
                "type" => "VARCHAR",
                "constraint" => 50,
                "default" => "is-info is-light",
            ],
            "display_order" => [
                "type" => "INT",
                "constraint" => 5,
                "default" => 0,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->addKey("project_id");
        $this->forge->addForeignKey("project_id", "projects", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("project_tags", true);

        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "project_id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
            ],
            "highlight" => [
                "type" => "TEXT",
            ],
            "display_order" => [
                "type" => "INT",
                "constraint" => 5,
                "default" => 0,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->addKey("project_id");
        $this->forge->addForeignKey("project_id", "projects", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("project_highlights", true);

        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "project_id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
            ],
            "label" => [
                "type" => "VARCHAR",
                "constraint" => 100,
            ],
            "url" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "display_order" => [
                "type" => "INT",
                "constraint" => 5,
                "default" => 0,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->addKey("project_id");
        $this->forge->addForeignKey("project_id", "projects", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("project_links", true);

        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "project_id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
            ],
            "button_label" => [
                "type" => "VARCHAR",
                "constraint" => 100,
            ],
            "modal_title" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "preview_url" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "download_url" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "display_order" => [
                "type" => "INT",
                "constraint" => 5,
                "default" => 0,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->addKey("project_id");
        $this->forge->addForeignKey("project_id", "projects", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("project_docs", true);

        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "level" => [
                "type" => "VARCHAR",
                "constraint" => 50,
            ],
            "years" => [
                "type" => "VARCHAR",
                "constraint" => 50,
            ],
            "location" => [
                "type" => "VARCHAR",
                "constraint" => 100,
            ],
            "school" => [
                "type" => "VARCHAR",
                "constraint" => 150,
            ],
            "details" => [
                "type" => "TEXT",
            ],
            "color" => [
                "type" => "VARCHAR",
                "constraint" => 20,
            ],
            "display_order" => [
                "type" => "INT",
                "constraint" => 5,
                "default" => 0,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->createTable("education", true);

        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 9,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "setting_key" => [
                "type" => "VARCHAR",
                "constraint" => 100,
            ],
            "setting_value" => [
                "type" => "TEXT",
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->addUniqueKey("setting_key");
        $this->forge->createTable("site_settings", true);
    }

    /**
     * Rollback schema changes.
     *
     * @return void
     */
    public function down()
    {
        $this->forge->dropTable("site_settings", true);
        $this->forge->dropTable("education", true);
        $this->forge->dropTable("project_docs", true);
        $this->forge->dropTable("project_links", true);
        $this->forge->dropTable("project_highlights", true);
        $this->forge->dropTable("project_tags", true);
        $this->forge->dropTable("projects", true);
        $this->forge->dropTable("skills", true);
        $this->forge->dropTable("skill_groups", true);
        $this->forge->dropTable("social_links", true);
        $this->forge->dropTable("profile_tags", true);
        $this->forge->dropTable("profiles", true);
    }
}
