<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 09/04/2018
 * Time: 11:14
 */

namespace App\Domain\Builder;


use App\Domain\Models\User;

class UserBuilder
{
    private $user;

    public function createFromRegistration(string $username, string $email, string $password, callable $passwordEncoder): self
    {
        $this->user = new User($username, $email, $password, $passwordEncoder);

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }
}
