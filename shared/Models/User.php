<?php

declare(strict_types=1);

/**
 * Quantum PHP Framework
 * An open-source software development framework for PHP
 * @link https://quantumphp.io
 */

namespace Shared\Models;

use Quantum\Model\Traits\HasTimestamps;
use Quantum\Model\DbModel;

/**
 * Class User
 * @package Shared\Models
 */
class User extends DbModel
{
    use HasTimestamps;

    /**
     * ID column of table
     * @var string
     */
    public string $idColumn = 'id';

    /**
     * The table name
     * @var string
     */
    public string $table = 'users';

    /**
     * Fillable properties
     * @var array<string>
     */
    public array $fillable = [
        'uuid',
        'firstname',
        'lastname',
        'role',
        'email',
        'password',
        'image',
        'activation_token',
        'remember_token',
        'reset_token',
        'access_token',
        'refresh_token',
        'otp',
        'otp_expires',
        'otp_token',
    ];
}
