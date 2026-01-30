<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Project highlight model for bullet points.
 */
class ProjectHighlightModel extends Model
{
    protected $table = "project_highlights";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "project_id",
        "highlight",
        "display_order",
    ];
}
