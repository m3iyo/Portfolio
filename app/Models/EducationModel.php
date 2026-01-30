<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Education model for schooling entries.
 */
class EducationModel extends Model
{
    protected $table = "education";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "level",
        "years",
        "location",
        "school",
        "details",
        "color",
        "display_order",
    ];
}
