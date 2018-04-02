<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 31/03/2018
 * Time: 17:36
 */

namespace App\UI\Action;


use App\Form\Type\ArticleType;
use App\UI\Responder\AddArticleResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/article", name="add_article")
 */
class AddArticleAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * AddArticleAction constructor.
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function __invoke(Request $request, AddArticleResponder $responder)
    {
        $addArticleType = $this->formFactory->create(ArticleType::class)->handleRequest($request);

        if ($addArticleType->isSubmitted() && $addArticleType->isValid()) {

        }

        return $responder($addArticleType);
    }
}
