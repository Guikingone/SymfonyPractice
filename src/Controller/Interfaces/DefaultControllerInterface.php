<?php
/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 19/03/2018
 * Time: 11:55
 */

namespace App\Controller\Interfaces;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Twig\Environment;

interface DefaultControllerInterface
{
    public function __invoke(Environment $environment, SessionInterface $session);
}
