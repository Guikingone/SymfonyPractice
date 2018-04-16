<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 16/04/2018
 * Time: 10:23
 */

namespace App\Tests\Domain\Models;

use App\Domain\Models\Article;
use PHPUnit\Framework\TestCase;


class ArticleTest extends TestCase
{
    public function testConstructor()
    {
        $article = new Article('Toto');

        static::assertSame(
            'Toto',
            $article->getArticle()
        );
    }

    public function testItReturnAnEmptyString()
    {
        $article = new Article('');

        static::assertSame(
            '',
            $article->getArticle()
        );
    }

    public function testSetContent()
    {
        $article = new Article('');
        $article->setContent(35);

        static::assertSame(
            35,
            $article->getArticle()
        );
    }
}
