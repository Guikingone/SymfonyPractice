<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 14/05/2018
 * Time: 10:44
 */

namespace App\Repository;

use App\Domain\Models\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $article)
    {
        $this->_em->persist($article);
        $this->_em->flush();
    }

    public function remove(Article $article)
    {
        $this->_em->remove($article);
        $this->_em->flush();
    }
}
