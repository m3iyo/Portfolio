<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Project link model for external buttons.
 */
class ProjectLinkModel extends Model
{
    protected $table = "project_links";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "project_id",
        "label",
        "url",
        "display_order",
    ];
}
