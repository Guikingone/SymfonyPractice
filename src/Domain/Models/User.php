<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 26/03/2018
 * Time: 11:33
 */

namespace App\Domain\Models;

class User
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $creationDate;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var string
     */
    private $resetPasswordToken;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $username,
        string $email,
        string $password,
        callable $passwordEncoder
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $passwordEncoder($password, null);
        $this->roles = ['ROLE_USER', 'ROLE_ADMIN'];
        $this->creationDate = time();
    }
}
