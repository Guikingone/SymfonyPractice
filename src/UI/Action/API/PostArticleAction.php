<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 14/05/2018
 * Time: 10:58
 */

namespace App\UI\Action\API;

use App\Domain\Models\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class PostArticleAction
 *
 * @Route(name="api_article_post", path="/api/article", methods={"POST"})
 */
class PostArticleAction
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
     * PostArticleAction constructor.
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
        $content = $this->serializer->deserialize($request->getContent(), Article::class, 'json');

        $this->articleRepository->save($content);

        return new JsonResponse('Hello from post');
    }
}
