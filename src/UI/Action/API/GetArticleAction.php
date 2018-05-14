<?php

declare(strict_types=1);

namespace App\UI\Action\API;

use App\Repository\ArticleRepository;
use App\UI\Responder\API\GetArticleResponder;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GetArticleAction
 *
 * @Route(name="api_article_get", path="/api/article", methods={"GET"})
 */
class GetArticleAction
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
     * @var GetArticleResponder
     */
    private $responder;

    /**
     * GetArticleAction constructor.
     *
     * @param ArticleRepository $articleRepository
     * @param SerializerInterface $serializer
     * @param GetArticleResponder $responder
     */
    public function __construct(
        ArticleRepository $articleRepository,
        SerializerInterface $serializer,
        GetArticleResponder $responder
    ) {
        $this->articleRepository = $articleRepository;
        $this->serializer = $serializer;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $responder = $this->responder;

        $data = $this->articleRepository->findAll();

        $content = $this->serializer->serialize($data, 'json', array('groups' => ['content']));

        return $responder($data);
    }
}
