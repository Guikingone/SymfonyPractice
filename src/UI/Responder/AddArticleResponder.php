<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 31/03/2018
 * Time: 17:38
 */

namespace App\UI\Responder;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AddArticleResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * AddArticleResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(FormInterface $addArticleType)
    {
        return new Response(
            $this->twig->render('index.html.twig', [
                'form' => $addArticleType->createView()
            ])
        );
    }
}
