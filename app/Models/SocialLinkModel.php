<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Social link model for hero icons.
 */
class SocialLinkModel extends Model
{
    protected $table = "social_links";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "label",
        "url",
        "icon_url",
        "display_order",
    ];
}
