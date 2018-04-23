<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 23/04/2018
 * Time: 11:53
 */

namespace App\Infra\Doctrine\Repository;


use App\Domain\Models\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllArticles()
    {
        return $this->createQueryBuilder('article')
                    ->getQuery()
                    ->getResult();
    }

    public function save(Article $article)
    {


        $this->_em->persist($article);
        $this->_em->flush();
    }
}
