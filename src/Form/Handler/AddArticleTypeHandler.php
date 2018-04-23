<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 02/04/2018
 * Time: 11:17
 */

namespace App\Form\Handler;

use App\Domain\Builder\ArticleBuilder;
use App\Form\Handler\Interfaces\AddArticleTypeHandlerInterface;
use App\Infra\Doctrine\Repository\ArticleRepository;
use Symfony\Component\Form\FormInterface;

class AddArticleTypeHandler implements AddArticleTypeHandlerInterface
{
    /**
     * @var ArticleBuilder
     */
    private $articleBuilder;

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * AddArticleTypeHandler constructor.
     *
     * @param ArticleBuilder $articleBuilder
     */
    public function __construct(ArticleRepository $repository, ArticleBuilder $articleBuilder)
    {
        $this->articleRepository = $repository;
        $this->articleBuilder = $articleBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $this->articleBuilder->create($form->getData()->content);

            $this->articleRepository->save($this->articleBuilder->getArticle());

            return true;
        }

        return false;
    }
}
