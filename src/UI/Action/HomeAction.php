<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 26/03/2018
 * Time: 10:30
 */

namespace App\UI\Action;

use App\Domain\Models\User;
use App\Event\CoucouEvent;
use App\Event\UserCreatedEvent;
use App\Helper\FileUploaderHelper;
use App\UI\Action\Interfaces\HomeActionInterface;
use App\UI\Responder\Interfaces\HomeResponderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeAction
 *
 * @Route(
 *     path="/"
 * )
 */
class HomeAction implements HomeActionInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var FileUploaderHelper
     */
    private $fileUploaderHelper;

    /**
     * HomeAction constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param FileUploaderHelper $fileUploaderHelper
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        FileUploaderHelper $fileUploaderHelper
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->fileUploaderHelper = $fileUploaderHelper;
    }

    public function __invoke(HomeResponderInterface $responder)
    {
        // formulaire qui créer un utilisateur.

        $user = new User('Toto', 'toto@gmail.com');

        $this->eventDispatcher->dispatch(UserCreatedEvent::NAME, new UserCreatedEvent($user));

        var_dump($this->fileUploaderHelper->getImageFolder());

        return $responder();
    }
}
