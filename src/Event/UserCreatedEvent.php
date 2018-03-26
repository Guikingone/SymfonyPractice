<?php

declare(strict_types=1);

namespace App\Event;

use App\Domain\Models\User;
use Symfony\Component\EventDispatcher\Event;

class UserCreatedEvent extends Event
{
    const NAME = 'user.created';

    /**
     * @var User
     */
    private $user;

    /**
     * UserCreatedEvent constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
