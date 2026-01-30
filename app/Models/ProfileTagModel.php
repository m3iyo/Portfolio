<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Profile tag model for hero badges.
 */
class ProfileTagModel extends Model
{
    protected $table = "profile_tags";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "profile_id",
        "label",
        "tag_class",
        "display_order",
    ];
}
