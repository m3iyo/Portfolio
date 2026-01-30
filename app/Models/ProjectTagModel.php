<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Project tag model for technology badges.
 */
class ProjectTagModel extends Model
{
    protected $table = "project_tags";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "project_id",
        "label",
        "tag_class",
        "display_order",
    ];
}
