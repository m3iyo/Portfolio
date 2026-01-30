<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Project doc model for modal documents.
 */
class ProjectDocModel extends Model
{
    protected $table = "project_docs";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "project_id",
        "button_label",
        "modal_title",
        "preview_url",
        "download_url",
        "display_order",
    ];
}
