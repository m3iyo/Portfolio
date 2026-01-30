<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Skill model for skill entries.
 */
class SkillModel extends Model
{
    protected $table = "skills";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "group_id",
        "label",
        "icon_url",
        "description",
        "display_order",
    ];
}
