<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 14/05/2018
 * Time: 11:13
 */

namespace App\UI\Action\API;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteArticleAction
 *
 * @Route(name="api_article_delete", path="/api/article/{id}", methods={"DELETE"})
 */
class DeleteArticleAction
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * DeleteArticleAction constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function __invoke(Request $request)
    {
        $article = $this->articleRepository->findOneBy(['id' => $request->attributes->get('id')]);

        $this->articleRepository->remove($article);

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
