<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 26/03/2018
 * Time: 11:29
 */

namespace App\Subscriber;

use App\Event\CoucouEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;

class CoucouSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            CoucouEvent::NAME => 'onCoucou'
        ];
    }

    public function onCoucou(CoucouEvent $event)
    {
        return new Response(
            $event->sayHello()
        );
    }
}
