<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model for persisting contact form messages.
 */
class ContactMessageModel extends Model
{
    /**
     * @var string
     */
    protected $table = "contact_messages";

    /**
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * @var string
     */
    protected $returnType = "array";

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var string
     */
    protected $createdField = "created_at";

    /**
     * @var string
     */
    protected $updatedField = "updated_at";

    /**
     * @var string[]
     */
    protected $allowedFields = [
        "name",
        "email",
        "message",
    ];
}
