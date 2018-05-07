<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Domain\Models\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $article = new Article('Toto');

        $manager->persist($article);
        $manager->flush();
    }
}
