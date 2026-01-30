<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Site setting model for key-value config.
 */
class SiteSettingModel extends Model
{
    protected $table = "site_settings";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "setting_key",
        "setting_value",
    ];
}
