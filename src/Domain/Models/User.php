<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;


class User
{
    /**
     * @var UuidInterface
     */
    private $id;

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
     * @var \ArrayAccess
     */
    private $articles;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $username,
        string $email,
        string $password,
        callable $passwordEncoder
    ) {
        $this->id = Uuid::uuid4();
        $this->username = $username;
        $this->email = $email;
        $this->password = $passwordEncoder($password, null);
        $this->roles = ['ROLE_USER', 'ROLE_ADMIN'];
        $this->creationDate = time();

        $this->articles = new ArrayCollection();
    }

    public function updateCredentials(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
    }
}
