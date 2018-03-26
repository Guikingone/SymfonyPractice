<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 26/03/2018
 * Time: 11:20
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class CoucouEvent extends Event
{
     const NAME = 'coucou.event';

     public function sayHello()
     {
         echo 'Hello World !';
     }
}
