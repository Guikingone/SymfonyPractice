<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 14/05/2018
 * Time: 11:25
 */

namespace App\UI\Action\API;


use App\Infra\Doctrine\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GetArticleByIdAction
 *
 * @Route(name="api_article_id_get", path="/api/article/{id}", methods={"GET"})
 */
class GetArticleByIdAction
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * GetArticleByIdAction constructor.
     * @param ArticleRepository $articleRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(ArticleRepository $articleRepository, SerializerInterface $serializer)
    {
        $this->articleRepository = $articleRepository;
        $this->serializer = $serializer;
    }

    public function __invoke(Request $request)
    {
        $article = $this->articleRepository->findOneBy(['id' => $request->attributes->get('id')]);

        return new JsonResponse($article);
    }
}
