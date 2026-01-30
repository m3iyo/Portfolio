<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Skill group model for skill categories.
 */
class SkillGroupModel extends Model
{
    protected $table = "skill_groups";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "name",
        "layout",
        "display_order",
    ];
}
