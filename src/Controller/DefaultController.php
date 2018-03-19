<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 19/03/2018
 * Time: 11:25
 */

namespace App\Controller;

use App\Controller\Interfaces\DefaultControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route(
 *     path="/",
 *     methods={"GET"}
 * )
 */
class DefaultController implements DefaultControllerInterface
{
    /**
     * @param Environment $environment
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Environment $environment, SessionInterface $session)
    {
        return new Response(
            $environment->render('index.html.twig')
        );
    }
}
