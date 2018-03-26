<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\HomeResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeResponder implements HomeResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * HomeResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke()
    {
        return new Response(
            $this->twig->render('index.html.twig')
        );
    }
}
