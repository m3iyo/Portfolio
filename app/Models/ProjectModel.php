<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Project model for portfolio projects.
 */
class ProjectModel extends Model
{
    protected $table = "projects";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "title",
        "display_order",
    ];
}
