<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Profile model for hero data.
 */
class ProfileModel extends Model
{
    protected $table = "profiles";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "name",
        "kicker",
        "headline",
        "subheadline",
        "resume_url",
        "contact_url",
    ];
    protected $useTimestamps = true;
    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
}
