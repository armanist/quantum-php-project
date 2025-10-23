<?php

/**
 * Quantum PHP Framework
 *
 * An open source software development framework for PHP
 *
 * @package Quantum
 * @author Arman Ag. <arman.ag@softberg.org>
 * @copyright Copyright (c) 2018 Softberg LLC (https://softberg.org)
 * @link http://quantum.softberg.org/
 * @since 2.9.8
 */

namespace Shared\Commands;

use Quantum\Service\Exceptions\ServiceException;
use Quantum\Service\Factories\ServiceFactory;
use Quantum\Libraries\Validation\Validator;
use Quantum\Di\Exceptions\DiException;
use Quantum\Libraries\Validation\Rule;
use Quantum\Libraries\Hasher\Hasher;
use Shared\Services\AuthService;
use Quantum\Console\QtCommand;
use ReflectionException;
use Shared\Models\User;

/**
 * Class UserCreateCommand
 * @package Shared\Commands
 */
class UserCreateCommand extends QtCommand
{

    /**
     * Command name
     * @var string
     */
    protected $name = 'user:create';

    /**
     * Command description
     * @var string
     */
    protected $description = 'Allows to create a user';

    /**
     * Command help text
     * @var string
     */
    protected $help = 'Use the following format to create a user record:' . PHP_EOL . 'php qt user:create `Email` `Password` `[Role]` `[Firstname]` `[Lastname]`';

    /**
     * Error message
     * @var string
     */
    protected $errorMessage;

    /**
     * Command arguments
     * @var array[]
     */
    protected $args = [
        ['email', 'required', 'User email'],
        ['password', 'required', 'User password'],
        ['uuid', 'optional', 'User uuid'],
        ['role', 'optional', 'User role'],
        ['firstname', 'optional', 'User firstname'],
        ['lastname', 'optional', 'User lastname'],
        ['image', 'optional', 'User image'],
    ];

    /**
     * Executes the command
     * @throws ReflectionException
     * @throws ServiceException
     * @throws DiException
     */
    public function exec()
    {
        if (!$this->validateEmail($this->getArgument('email'))) {
            $this->error($this->errorMessage);
            return;
        }

        $authService = ServiceFactory::get(AuthService::class);

        $user = [
            'uuid' => $this->getArgument('uuid'),
            'firstname' => $this->getArgument('firstname'),
            'lastname' => $this->getArgument('lastname'),
            'role' => $this->getArgument('role'),
            'email' => $this->getArgument('email'),
            'password' => (new Hasher())->hash($this->getArgument('password')),
            'image' => $this->getArgument('image'),
        ];

        $authService->add($user);

        $this->info('User created successfully');
    }

    /**
     * Validate email
     * @param string $email
     * @return boolean
     */
    private function validateEmail(string $email): bool
    {
        $validator = new Validator();

        $validator->setRules([
            'email' => [
                Rule::required(),
                Rule::email(),
                Rule::unique(User::class, 'email')
            ],
        ]);

        if (!$validator->isValid(['email' => $email])) {
            $this->errorMessage = $validator->getErrors()['email'][0];
            return false;
        }

        return true;
    }
}