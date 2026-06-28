<?php

declare(strict_types=1);

/**
 * Quantum PHP Framework
 * An open-source software development framework for PHP
 * @link https://quantumphp.io
 */

namespace Shared\Models;

use Quantum\Model\Traits\HasTimestamps;
use Quantum\Model\Traits\SoftDeletes;
use Quantum\Database\Enums\Relation;
use Quantum\Model\DbModel;

/**
 * Class Comment
 * @package Shared\Models
 */
class Comment extends DbModel
{
    use HasTimestamps;
    use SoftDeletes;

    /**
     * ID column of table
     * @var string
     */
    public string $idColumn = 'id';

    /**
     * The table name
     * @var string
     */
    public string $table = 'comments';

    /**
     * Fillable properties
     * @var array<string>
     */
    public array $fillable = [
        'uuid',
        'post_uuid',
        'user_uuid',
        'content',
    ];

    /**
     * Model relations configuration
     * @return array[]
     */
    public function relations(): array
    {
        return [
            User::class => [
                'type' => Relation::BELONGS_TO,
                'foreign_key' => 'user_uuid',
                'local_key' => 'uuid',
            ],
        ];
    }
}
